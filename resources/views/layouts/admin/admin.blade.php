<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/admin.css'])

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"
        integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



</head>

<body>
    @include('layouts.admin.navbar')

    @include('layouts.admin.sidebar')

    @include('components.toast')















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script>
        // toast
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl) // No need for options; use the default options
        });
        toastList.forEach(toast => toast.show()); // This show them


        // validation bootstrap
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

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

        // active tabs bootstrap
        const pillsTab = document.querySelector('#myTab');
        const pills = pillsTab.querySelectorAll('button[data-bs-toggle="tab"]');

        pills.forEach(pill => {
            pill.addEventListener('shown.bs.tab', (event) => {
                const {
                    target
                } = event;
                const {
                    id: targetId
                } = target;

                savePillId(targetId);
            });
        });

        const savePillId = (selector) => {
            localStorage.setItem('activePillId', selector);
        };

        const getPillId = () => {
            const activePillId = localStorage.getItem('activePillId');

            if (!activePillId) return;

            // call 'show' function
            const someTabTriggerEl = document.querySelector(`#${activePillId}`)
            const tab = new bootstrap.Tab(someTabTriggerEl);

            tab.show();
        };

        getPillId();
    </script>
</body>

</html>
