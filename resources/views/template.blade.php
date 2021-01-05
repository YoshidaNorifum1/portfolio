<!doctype html>
<html>
  <head>
    <title>YOSHIDA Norifumi's Portfolio</title>
    <link href="/css/template.css" rel="stylesheet" type="text/css">
    <link href=@yield("css_address") rel="stylesheet" type="text/css">
  <body>
      <div class="header">
        <div class="header_title">
           YOSHIDA Norifumi's
        </div>
        <div class="header_title">
          Portfolio
        </div>
      </div>
      <div class="wrapper">
        <div class="left_contents">
          <div class="left_drawer">
           Menu 
          </div>
          <div class="left_wrapper">
            <div class="left_content" href="/#">
              <a class="btn_1" href="/">
                HOME
              </a>
              </div>
              <div class="left_content" href="/#">
              <a class="btn_2" href="/about">
                ABOUT
              </a>
              </div>
              <div class="left_content" href="/#">
              <a class="btn_3" href="/works">
                WORKS
              </a>
            </div>
          </div>
      </div>
      <div class="right_contents">
        <div class="right_contents_border">
        </div>
        @yield('right_contents')
      </div>

    </body>
  </head>
</html>
