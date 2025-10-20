<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Particles styles (kept same as your sample) -->
    <style>
      /* ---- reset ---- */
      body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; }
      canvas{ display:block; vertical-align: bottom; }

      /* ---- particles.js container ---- */
      #particles-js{
        position:absolute; top:0; left:0;
        width:100%; height:100%;
        background-color:#000000;
        background-image:url("");
        background-repeat:no-repeat;
        background-size:cover;
        background-position:50% 50%;
        z-index:0;
        pointer-events:auto; /* Allow hover interactions for particles */
      }

      /* Keep main content above particles */
      main, .content, svg {
        position:relative;
        z-index:1;
        pointer-events:none; /* Prevent main blocking hover on particles */
      }

      /* Allow interactive elements to work */
      nav, button, a, input, select, textarea, .interactive-element {
        position:relative;
        z-index:2;
        pointer-events:auto;
      }

      /* ---- stats.js (optional) ---- */
      .count-particles{
        background:#000022; position:absolute; top:48px; left:0; width:80px;
        color:#13E8E9; font-size:.8em; text-align:left; text-indent:4px; line-height:14px; padding-bottom:2px;
        font-family:Helvetica, Arial, sans-serif; font-weight:bold; border-radius:0 0 3px 3px;
      }
      .js-count-particles{ font-size:1.1em; }
      #stats{ border-radius:3px 3px 0 0; overflow:hidden; -webkit-user-select:none; }
    </style>

    <!-- Particles.js (served from public/js) -->
    <script src="{{ asset('js/particles.min.js') }}"></script>
    <script src="{{ asset('js/stats.min.js') }}"></script>
</head>
<body class="font-sans antialiased bg-black min-h-full">
  {{-- Particles layer (behind everything) --}}
  <div id="particles-js"></div>

  {{-- Top navigation above particles --}}
  @include('layouts.navigation')

  {{-- Decorative wave (above particles) --}}
  <svg xmlns="http://www.w3.org/2000/svg" id="visual" viewBox="0 0 1080 38" class="absolute left-0 w-full z-10">
    <path d="M0 34L60 38L120 1L180 23L240 30L300 12L360 24L420 12L480 19L540 37L600 10L660 21L720 23L780 1L840 24L900 3L960 19L1020 5L1080 15L1080 0L1020 0L960 0L900 0L840 0L780 0L720 0L660 0L600 0L540 0L480 0L420 0L360 0L300 0L240 0L180 0L120 0L60 0L0 0Z"
          fill="#ffffff" stroke-linecap="square" stroke-linejoin="bevel"/>
  </svg>

  <div class="sm:py-0 py-12"></div>

  <!-- Page Content (above particles) -->
  <main>
    {{ $slot }}
  </main>

  <!-- Initialize Particles (same config you gave) -->
  <script>
    (function initParticles(){
      if (!window.particlesJS) return console.warn('particles.min.js not found at /public/js');
      particlesJS("particles-js", {
        "particles":{
          "number":{"value":20,"density":{"enable":true,"value_area":800}},
          "color":{"value":"#ffffff"},
          "shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},
            "polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},
          "opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},
          "size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},
          "line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.75,"width":1},
          "move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,
            "attract":{"enable":false,"rotateX":600,"rotateY":1200}}
        },
        "interactivity":{
          "detect_on":"canvas",
          "events":{"onhover":{"enable":true,"mode":"grab"},"onclick":{"enable":true,"mode":"push"},"resize":true},
          "modes":{
            "grab":{"distance":400,"line_linked":{"opacity":1}},
            "bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},
            "repulse":{"distance":200,"duration":0.4},
            "push":{"particles_nb":4},
            "remove":{"particles_nb":2}
          }
        },
        "retina_detect":true
      });

      // stats (optional)
      if (window.Stats) {
        var stats = new Stats();
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);

        var update = function() {
          stats.begin(); stats.end();
          requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
      }
    })();
  </script>

  {{-- <x-footer/> --}}
</body>
</html>
