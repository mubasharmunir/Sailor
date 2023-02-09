@extends('layouts.app')
@section('title' , 'contact')
@section('content')
<body>
  <!-- ======= Contact Section ======= -->
  <li><a href="{{route('contact')}}"><h1>Contact US</h1></a></li>
  <section id="contact" class="contact">
    <div class="container">
      <div>
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div>
      <div class="row mt-5">
        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>Officer Colony Near Lahore CMH , Lahore Cantt</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>asfan796@gmail.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+92 303 7913413</p>
            </div>

          </div>

        </div>
        @if(Session::get('message_sent'))
        <div class="alert-alert-success" role="alert">
            {{Session::get('message_sent')}}
        </div>
        @endif
        <div class="col-lg-8 mt-5 mt-lg-0">
          <form action="{{route('contact.send')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>
                <input type="text" name="name" class="form-control" />
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
        </div>
            <div class="form-group">
                <label for="email">Email</label>
                  <input type="text" name="email"  class="form-control" />
                  @error('email')
                  <div class="alert alert-danger" role="alert">
                      {{$message}}
                  </div>
                  @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone No</label>
                  <input type="text" name="phone" class="form-control" />
                  @error('phone')
                  <div class="alert alert-danger" role="alert">
                      {{$message}}
                  </div>
                  @enderror
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                  <input type="text" name="subject" class="form-control" />
                  @error('subject')
                  <div class="alert alert-danger" role="alert">
                      {{$message}}
                  </div>
                  @enderror
           </div>
            <div class="form-group">
                <label for="message">Message</label>
            <textarea name="message" class="form-control"></textarea>
            @error('message')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
           </div>
            <button type="submit" class="btn btn-primary float-right">Submit</button></div>
         </div>
          {{-- <input type="hidden" name="contact" value="{{$contact}}"/> --}}
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
</body>
@endsection
