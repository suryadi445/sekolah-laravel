import './bootstrap';

// VALIDASI BOOTSTRAP
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()
// END VAIDASI BOOTSTRAP


$(document).ready(function () {
    // STAY ACTIVE TAB WHEN RELOAD
    $('a[data-toggle="tab"]').on('show.affectedDiv.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }

    $('#carouselExampleIndicators').carousel({
        interval: 4000,
        wrap: true,
        keyboard: true
    });


    /* 2 carousel */
    $('#carouselExampleIndicators2').carousel({
        interval: 5000,
        wrap: true,
        keyboard: true
    });
});
