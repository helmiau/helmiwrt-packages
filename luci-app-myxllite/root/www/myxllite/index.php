<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cek Kuota XL</title>
    <link rel="stylesheet" href="assets/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <!-- Navbar -->
    <nav class="sticky-top bg-light">
      <div class="container-sm sticky-top">
        <nav class="navbar sticky-top navbar-expand-lg bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">MY XL Lite</a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
              <form class="d-flex" role="search">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      role="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      Menu
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a
                          class="dropdown-item"
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#staticBackdrop"
                          >Atur Nomer XL</a
                        >
                      </li>
                      <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#about">Tentang</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </form>
              <form class="d-flex" id="d-flex" action="redirect.php">
                <a
                  id="updatebutton"
                  class="btn btn-primary"
                  href="redirect.php"
                >
                  Refresh
                </a>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </nav>
    <!-- Navbar End -->
    <div class="container-sm">
      <!-- Loader -->
      <div class="spinner-loading" id="spinner-loading">
        <div class="d-flex justify-content-center m-5">
          <div
            class="spinner-border"
            style="width: 4rem; height: 4rem"
            role="status"
          >
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
      <!-- Modal Set Nomer-->
      <div
        class="modal fade"
        id="staticBackdrop"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Atur nomer XL
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="setNomer.php" method="post">
              <div class="modal-body">
                <input
                  type="text"
                  aria-label="First name"
                  class="form-control"
                  name="nomer"
                />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Kembali
                </button>
                <button class="btn btn-primary" type="submit">
                  Ubah
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <!-- Modal About-->
      <div class="modal fade " id="about" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            
            <div class="modal-body">
              ada eror atau request apa bisa ke telegram @rizkirmdhnnnnnn
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Main -->
      <div class="row" id="row"></div>
    </div>
    <script src="assets/script.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
