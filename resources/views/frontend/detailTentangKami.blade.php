@extends('layouts.landing')


@section('container')
    <section id="history">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Sejarah Sekolah</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quibusdam modi
                        quam. Ipsam
                        nostrum
                        maiores distinctio tempora nihil, molestias, quae necessitatibus veritatis sed,
                        alias
                        recusandae
                        qui
                        delectus cum voluptatibus temporibus!
                    </p>
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset('images/upload/image.png') }}" class="img-fluid" alt="image">
                </div>
            </div>
        </div>
    </section>

    <section id="peta">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15863.145812678567!2d106.73525875!3d-6.2917732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0092fae80c5%3A0x439cd2b52dc67b80!2sJurang%20Mangu!5e0!3m2!1sid!2sid!4v1671331966032!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
