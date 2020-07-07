<script>
$(document).ready(function(){
    let form = document.getElementById("form");
    form.addEventListener('submit', function(event) {

        event.preventDefault();
        event.stopPropagation();

        if (this.checkValidity() === false) {
            form.classList.add('was-validated');
        }else{
                $.ajax({
                    type: "POST",
                    url: window.location.href,
                    data: $('#form').serialize(),
                    success: function(result) {
                        if (result === 'auth'){
                            document.location.href = window.location.origin+'/index.php?r=site/login';
                        }else{
                            alert(result);
                            document.location.href = window.location.origin;
                        }

                    }
                });
        }
    }, false);
});
</script>

<form id="form" method="post" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="name">Имя:</label>
        <input type="text" class="form-control" id="name" name="name" required
            <?php if (isset($model['name'])) echo "value=\"{$model['name']}\""; ?>
        >
        <div class="invalid-feedback">Поле Имя не должно быть пустым</div>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required
            <?php if (isset($model['email'])) echo "value=\"{$model['email']}\""; ?>
        >
        <div class="invalid-feedback">Поле не соотвествует формату Email</div>
    </div>

    <div class="form-group">
        <label for="text">Текст:</label>
        <textarea  class="form-control" id="text" name="text" required><?php if (isset($model['text'])) echo trim($model['text']);?></textarea>
        <div class="invalid-feedback">Поле Текст не должно быть пустым</div>
    </div>

    <?php if(Core\App::$isAdmin) :?>
    <div class="form-group">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="completed"
                    <?php if (isset($model['completed'])) echo $model['completed'] == 1? 'checked' : ''; ?>
                >Выполнено
            </label>
        </div>
    </div>
    <?php endif;?>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>