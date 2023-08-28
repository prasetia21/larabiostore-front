@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth" id="register">
      <section class="store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center justify-content-center row-login">
            <div class="col-lg-4 mt-5">
              <h2>Beli Produk Cat Lebih Mudah lewat<br/>
                  BIO WEBSTORE
              </h2>
                <form method="POST" action="{{ route('register') }}" class="mt-3">
                    @csrf
                  <div class="form-group">
                    <label>Full Name</label>
                    <input id="name" v-model="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input 
                      id="email" 
                      @change="chcekForEmailAvailability()" 
                      type="email" 
                      class="form-control rounded-pill @error('email') is-invalid @enderror" 
                      :class="{'is-invalid' : this.email_unavailable}"
                      name="email" 
                      v-model="email" 
                      value="{{ old('email') }}" 
                      required 
                      autocomplete="email">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input id="password-confirmation" type="password" class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                      @error('password_confirmation')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <!-- <div class="form-group">
                    <label>Store </label>
                    <p class="text-muted">
                      Apakah anda juga ingin membuka toko?
                    </p>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue" v-model="is_store_open" :value="true"
                      />
                      <label for="openStoreTrue" class="custom-control-label">
                        Iya, boleh
                      </label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse" v-model="is_store_open" :value="false" />
                      <label for="openStoreFalse" class="custom-control-label">
                        Enggak, makasih
                      </label>
                    </div>
                  </div>
                  <div class="form-group" v-if="is_store_open">
                    <label>Nama Toko</label>
                    <input type="text"
                    v-model="store_name"
                    id="store_name"
                    class="form-control rounded-pill @error('password_confirm') is-invalid @enderror"
                    name="store_name"
                    required
                    autocomplete
                    autofocus
                    >
                    @error('store_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group" v-if="is_store_open">
                    <label>Category</label>
                    <select name="categories_id" class="form-control rounded-pill" id="">
                      <option value="" >Select Category</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div> -->

                  <button type="submit" class="btn btn-success btn-block mt-4 py-2 rounded-pill" :disabled="this.email_unavailable">
                    Sign Up Now
                  </button>
                  <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-3 py-2 rounded-pill">
                    Back To Sign In
                  </a>
                </form>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: '#register',
        mounted(){
          AOS.init();
          
        },
        methods:{
          chcekForEmailAvailability: function(){
            var self = this;
            axios.get('{{ route('api-register-check') }}', {
              params: {
                email: this.email
              }
            })
              .then(function (response) {
                if(response.data == 'Available'){
                    self.$toasted.show(
                      "Email anda tersedia! Silakan lanjut langkah selanjutnya!",
                      {
                        position: "top-center",
                        className: "rounded",
                        duration: 1000
                      }
                    );
                      self.email_unavailable = false;

                } else {
                      self.$toasted.error(
                        "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 1000
                        }
                      );
                      self.email_unavailable = true;
                }

                // handle success
                console.log(response);
              });
          }
        },
        data(){
          return {
            name: "",
            email: "",
            // is_store_open: true,
            // store_name: "",
            email_unavailable: false,
          }
        }
      })
    </script>
@endpush