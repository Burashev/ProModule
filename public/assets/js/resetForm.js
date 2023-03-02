const forms = document.querySelectorAll('form');

forms.forEach(form => {
    form.querySelector('button[type="reset"]').addEventListener("click", function (e) {
        e.preventDefault();
        form.reset();
        // сбрасываем select2
        form.querySelectorAll('select[multiple]').forEach(select => {
            $(select).val(null).trigger('change');
        });

    })
});
