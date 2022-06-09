@extends('layouts.admin')
@section('title')
    Chat
@endsection
@section('content')

<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('images\users/' . Auth::user()->image) }}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        CEO / Co-Founder
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active "  href="{{route('user.payments')}}"
                                role="tab" aria-selected="true">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(603.000000, 0.000000)">
                                                    <path class="color-background"
                                                        d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                    </path>
                                                    <path class="color-background"
                                                        d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                        opacity="0.7"></path>
                                                    <path class="color-background"
                                                        d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                        opacity="0.7"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">My Payments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="{{route('users.chat')}}" role="tab"
                                aria-selected="false">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>document</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(154.000000, 300.000000)">
                                                    <path class="color-background"
                                                        d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                        opacity="0.603585379"></path>
                                                    <path class="color-background"
                                                        d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">Messages</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{---------------------------- chat -------------------------------------}}
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-4">
        <div class="card blur shadow-blur max-height-vh-70 overflow-auto overflow-x-hidden mb-5 mb-lg-0">
          <div class="card-header p-3">
            <h6>Friends</h6>
            <input type="email" class="form-control" placeholder="Search Contact" aria-label="Email">
          </div>
          <div class="card-body p-2">
            <a href="javascript:;" class="d-block p-2 border-radius-lg bg-gradient-primary">
              <div class="d-flex p-2">
                <img alt="Image" src="../../assets/img/team-2.jpg" class="avatar shadow">
                <div class="ms-3">
                  <div class="justify-content-between align-items-center">
                    <h6 class="text-white mb-0">Charlie Watson
                      <span class="badge badge-success"></span>
                    </h6>
                    <p class="text-white mb-0 text-sm">Typing...</p>
                  </div>
                </div>
              </div>
            </a>
            <a href="javascript:;" class="d-block p-2">
              <div class="d-flex p-2">
                <img alt="Image" src="../../assets/img/team-1.jpg" class="avatar shadow">
                <div class="ms-3">
                  <h6 class="mb-0">Jane Doe</h6>
                  <p class="text-muted text-xs mb-2">1 hour ago</p>
                  <span class="text-muted text-sm col-11 p-0 text-truncate d-block">Computer users and programmers</span>
                </div>
              </div>
            </a>
            <a href="javascript:;" class="d-block p-2">
              <div class="d-flex p-2">
                <img alt="Image" src="../../assets/img/team-3.jpg" class="avatar shadow">
                <div class="ms-3">
                  <h6 class="mb-0">Mila Skylar</h6>
                  <p class="text-muted text-xs mb-2">24 min ago</p>
                  <span class="text-muted text-sm col-11 p-0 text-truncate d-block">You can subscribe to receive weekly...</span>
                </div>
              </div>
            </a>
            <a href="javascript:;" class="d-block p-2">
              <div class="d-flex p-2">
                <img alt="Image" src="../../assets/img/team-5.jpg" class="avatar shadow">
                <div class="ms-3">
                  <h6 class="mb-0">Sofia Scarlett</h6>
                  <p class="text-muted text-xs mb-2">7 hours ago</p>
                  <span class="text-muted text-sm col-11 p-0 text-truncate d-block">It’s an effective resource regardless..</span>
                </div>
              </div>
            </a>
            <a href="javascript:;" class="d-block p-2">
              <div class="d-flex p-2">
                <img alt="Image" src="../../assets/img/team-4.jpg" class="avatar shadow">
                <div class="ms-3">
                  <div class="justify-content-between align-items-center">
                    <h6 class="mb-0">Tom Klein</h6>
                    <p class="text-muted text-xs mb-2">1 day ago</p>
                  </div>
                  <span class="text-muted text-sm col-11 p-0 text-truncate d-block">Be sure to check it out if your dev pro...</span>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
       {{---------------------------------- messages ------------------------------}}
      <div class="col-8">
        <div class="card blur shadow-blur max-height-vh-70">
          <div class="card-header shadow-lg">
            <div class="row">
              <div class="col-md-10">
                <div class="d-flex align-items-center">
                  <img alt="Image" src="../../assets/img/team-2.jpg" class="avatar">
                  <div class="ms-3">
                    <h6 class="mb-0 d-block">Charlie Watson</h6>
                    <span class="text-sm text-dark opacity-8">last seen today at 1:53am</span>
                  </div>
                </div>
              </div>
              <div class="col-1 my-auto pe-0">
                <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Video call">
                  <i class="ni ni-camera-compact"></i>
                </button>
              </div>
              <div class="col-1 my-auto ps-0">
                <div class="dropdown">
                  <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                    <i class="ni ni-settings"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body overflow-auto overflow-x-hidden">
           
            <div class="row justify-content-end text-right mb-4">
              <div class="col-auto">
                <div class="card bg-gray-200">
                  <div class="card-body py-2 px-3">
                    <div class="mb-0" id="messages">
                        
                    </div>
                    <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                      <i class="ni ni-check-bold text-sm me-1"></i>
                      <small>4:42pm</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
          <div class="card-footer d-block">
            <form class="align-items-center" id="message_form">
              <div class="d-flex">
                <div class="input-group">
                  <input type="text" id="message_input" name="message" class="form-control" placeholder="Type here" aria-label="Message example input">
                </div>
                <button type="submit" id="message_send" class="btn bg-gradient-primary mb-0 ms-2">
                  <i class="ni ni-send"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="./js/app.js"></script>

@endsection