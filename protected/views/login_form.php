<script>
// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            },
                false);
        });
    }, false);
})();
</script>
<div style="margin-top: 100px">
<form name="login" method="post" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="uname">Пользователь:</label>
        <input type="text" class="form-control" id="uname" placeholder="Введите имя" name="uname" required>
        <div class="invalid-feedback">Поле пользователь не может быть пустым</div>
    </div>
    <div class="form-group">
        <label for="pwd">Пароль:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Введите пароль" name="pswd" required>
        <div class="invalid-feedback">Поле пароль не может быть пустым</div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php
if (isset($message)) echo "<div style='text-align: center; color: #dc3545'>{$message}</div>";
?>

