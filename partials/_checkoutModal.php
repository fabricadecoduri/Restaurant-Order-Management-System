<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModal">Detalii pentru Livrare - Craiova</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="checkout.php" method="post">
                <!-- Orașul fix Craiova -->
                <div class="form-group">
                    <b><label for="city">Oraș:</label></b>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Craiova" value="Craiova" readonly>
                </div>
                <div class="form-group">
                    <b><label for="street">Stradă:</label></b>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Strada Principala" required>
                </div>
                <div class="form-group">
                    <b><label for="number">Număr:</label></b>
                    <input type="text" class="form-control" id="number" name="number" placeholder="123" required>
                </div>
                <div class="form-group">
                    <b><label for="block">Bloc:</label></b>
                    <input type="text" class="form-control" id="block" name="block" placeholder="Bloc A" required>
                </div>
                <div class="form-group">
                    <b><label for="apartment">Apartament:</label></b>
                    <input type="text" class="form-control" id="apartment" name="apartment" placeholder="10" required>
                </div>

                <!-- Telefon -->
                <div class="form-group">
                    <b><label for="phone">Nr. Tel:</label></b>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">+40</span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx" required pattern="[0-9]{10}" maxlength="10">
                    </div>
                </div>

                <!-- Observații -->
                <div class="form-group">
                    <b><label for="notes">Observații:</label></b>
                    <textarea class="form-control" id="notes" name="notes" placeholder="Detalii suplimentare pentru livrare" rows="3"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
                    <input type="hidden" name="amount" value="<?php echo $totalPrice ?>"> <!-- Asigură-te că $totalPrice este definit corect -->
                    <button type="submit" name="checkout" class="btn btn-success">Comandă</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>