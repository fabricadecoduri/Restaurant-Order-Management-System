<?php
session_start();
include 'partials/_dbconnect.php';
require __DIR__ . "/vendor/autoload.php";

// Configurare Stripe
$stripe_secret_key = "TOKEN_SECRET_KEY"; // Înlocuiește cu cheia ta secretă Stripe
\Stripe\Stripe::setApiKey($stripe_secret_key);

$_SESSION['orderId'] = 18; // ID-ul comenzii
$_SESSION['userId'] = 3; // ID-ul utilizatorului

// Verificare sesiune
if (!isset($_SESSION['orderId']) || !isset($_SESSION['userId'])) {
    echo "Sesiunea nu este setată corect. Asigură-te că ai un ID de comandă și utilizator.";
    exit();
}

$orderId = $_SESSION['orderId'];
$userId = $_SESSION['userId'];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Formularul nu a fost trimis prin POST.";
    exit();
}

// Preluare date formular
$city = $_POST['city'] ?? '';
$street = $_POST['street'] ?? '';
$number = $_POST['number'] ?? '';
$block = $_POST['block'] ?? '';
$apartment = $_POST['apartment'] ?? '';
$phone = $_POST['phone'] ?? '';
$notes = $_POST['notes'] ?? '';
$total = $_POST['amount'] ?? 0;

// Verificare completare câmpuri
if (empty($city) || empty($street) || empty($number) || empty($block) || empty($apartment) || empty($phone) || empty($total)) {
    echo "Toate câmpurile sunt obligatorii.";
    exit();
}

// Construiește adresa completă
$address = "Strada $street, Nr. $number, Bloc $block, Ap. $apartment, $city";

// Construire articole pentru Stripe
$line_items = [];
$sql = "SELECT vc.itemQuantity, p.pizzaName, p.pizzaPrice 
        FROM viewcart vc 
        JOIN pizza p ON vc.pizzaId = p.pizzaId 
        WHERE vc.userId = $userId";
$result = mysqli_query($conn, $sql);

// Verificare conexiune și rezultat interogare
if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

if (!$result) {
    echo "Eroare la interogarea bazei de date: " . mysqli_error($conn);
    exit();
}

// Adaugare produse în line_items
while ($row = mysqli_fetch_assoc($result)) {
    $line_items[] = [
        "quantity" => $row['itemQuantity'],
        "price_data" => [
            "currency" => "ron",
            "unit_amount" => $row['pizzaPrice'] * 100, // Stripe cere prețul în cenți
            "product_data" => [
                "name" => $row['pizzaName']
            ]
        ]
    ];
}

// Adaugă taxa de transport dacă totalul este sub 250 RON
if ($total < 250) {
    $line_items[] = [
        "quantity" => 1,
        "price_data" => [
            "currency" => "ron",
            "unit_amount" => 2000, // 20 RON în cenți
            "product_data" => [
                "name" => "Taxă de transport"
            ]
        ]
    ];
}

// Creează sesiunea Stripe
try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "payment_method_types" => ["card"],
        "line_items" => $line_items,
        "mode" => "payment",
        "success_url" => "http://localhost/tavernarsr.ro/success.php?session_id={CHECKOUT_SESSION_ID}",
        "cancel_url" => "http://localhost/tavernarsr.ro/index.php",
        "metadata" => [
            "userId" => $userId,
            "address" => $address,
            "phone" => $phone,
            "notes" => $notes
        ]
    ]);

    // Redirecționează utilizatorul către Stripe
    header("Location: " . $checkout_session->url);
    exit();
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Eroare Stripe API: " . $e->getMessage();
    exit();
} catch (Exception $e) {
    echo "Eroare generală: " . $e->getMessage();
    exit();
}
?>