@extends('website.layout.structure')

@section('main_container')
  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container px-0">
      <div class="heading_container ">
        <h2 class="">
          Login Us
        </h2>
      </div>
    </div>
    <div class="container container-bg">
      <div class="row">
        
        <div class="col-md-6 col-lg-6 offset-md-3 px-0">
          <form action="{{url('/login_auth')}}" method="post">
			@csrf
            <div>
              <input type="email" name="username" placeholder="Email" />
            </div>
            <div>
              <input type="password" name="password" placeholder="Password" />
            </div>
            
            <div class="d-flex ">
              <input type="submit" name="submit" value="Login" class="btn btn-danger">
			  <a href="signup">If you not register then click here for Signup</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->
@endsection
  