<section id="counter" style="background-color: #0a2540">
    <div class="container text-light pt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="row text-center">
                    <div class="col-sm-4">
                        <h3>Jumlah Siswa</h3>
                        <h2 class="Count">200</h2>
                    </div>
                    <div class="col-sm-4">
                        <h3>Jumlah Guru</h3>
                        <h2 class="Count">200</h2>
                    </div>
                    <div class="col-sm-4">
                        <h3>Jumlah Alumni</h3>
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
