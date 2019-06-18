@extends('template')

@section('content')
<title>Majapedia | Verifikasi Email</title>
<section class="top-letest-product-section">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <!-- <div class="card-header">{{ __('Verify Your Email Address') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Verifikasi Email</a></h5>
                      </div>
                      @if (session('resent'))
                          <div class="alert alert-success" role="alert">
                              {{ __('Link verifikasi yang baru telah dikirim ke email Anda.') }}
                          </div>
                      @endif

                      {{ __('Silahkan cek email Anda untuk melakukan verifikasi.') }}
                      {{ __('Jika anda tidak menerima email,') }} <a href="{{ route('verification.resend') }}">{{ __('coba kirim kembali') }}</a>.
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
