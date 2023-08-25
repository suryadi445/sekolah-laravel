
$(document).ready(function () {

    // var isFirstLogin = localStorage.getItem('isFirstLogin');
    // if (isFirstLogin != 'true') {
    //     localStorage.setItem('isFirstLogin', 'true');
    //     localStorage.setItem('isFirstLogin', 'false');
    // } else {
    //     localStorage.clear();
    // }


    $(".select2").select2({
        theme: 'bootstrap-5',
    });

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $('.nav-link.has-child').click(function (e) {
        e.stopPropagation();

        var childMenu = $(this).next('.nav-child');

        // Toggle class "show" untuk menampilkan/sembunyikan child menu
        childMenu.toggleClass('show');
        childMenu.addClass('active');

        if (childMenu.hasClass('show')) {
            childMenu.removeClass('show');
        } else {
            childMenu.addClass('show');
        }

        // cek local storage
        var childSlideshow = localStorage.getItem('childMenuOpen_slideshow');
        var childMaster = localStorage.getItem('childMenuOpen_master');
        if (childSlideshow === 'true') {
            localStorage.removeItem('childMenuOpen_slideshow');
            $('.parent2').addClass('active')
            $('.parent1').removeClass('active')

        }
        if (childMaster === 'true') {
            localStorage.removeItem('childMenuOpen_master');
            $('.parent1').addClass('active')
            $('.parent2').removeClass('active')
        }

        var parentId = $(this).data('parent-id');
        var isChildMenuOpen = childMenu.hasClass('active');
        localStorage.setItem('childMenuOpen_' + parentId, isChildMenuOpen);
    });


    // Cek status child menu dari localStorage saat halaman dimuat kembali
    $('.nav-link.has-child').each(function () {
        var parentId = $(this).data('parent-id');
        var isChildMenuOpen = localStorage.getItem('childMenuOpen_' + parentId);
        if (isChildMenuOpen === 'true') {
            $(this).next('.nav-child').addClass('show');
        }
    });


    $('.nav-link.nav-single').click(function () {

        // Cari elemen parent nya
        var childMenu = $(this).next('.has-child');

        childMenu.toggleClass('collapse');

        var childSlideshow = localStorage.getItem('childMenuOpen_slideshow');
        var childMaster = localStorage.getItem('childMenuOpen_master');
        if (childSlideshow === 'true') {
            localStorage.removeItem('childMenuOpen_slideshow');
        }
        if (childMaster === 'true') {
            localStorage.removeItem('childMenuOpen_master');
        }
    });
});
