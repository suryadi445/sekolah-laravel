<section id="counter">
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="row text-center">
                    <div class="col-sm-4">
                        <h1>Jumlah Siswa</h1>
                        <h2 class="Count">200</h2>
                    </div>
                    <div class="col-sm-4">
                        <h1>Jumlah Guru</h1>
                        <h2 class="Count">200</h2>
                    </div>
                    <div class="col-sm-4">
                        <h1>Jumlah Alumni</h1>
                        <h2 class="Count">200</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script>
    $('.Count').each(function() {
        var $this = $(this);
        jQuery({
            Counter: 0
        }).animate({
            Counter: $this.text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function() {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
</script>
