$(document).ready(function () {
    $(".select2").select2({
        theme: 'bootstrap-5',
    });

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
});
