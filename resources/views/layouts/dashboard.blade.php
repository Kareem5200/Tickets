<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

</head>

<body>

    <div class="wrapperAdmin">
        <aside id="sidebar" class="sticky-left">
          <div class="d-flex fanzone_container">
            <button class="toggle-btn-admin" type="button">
                <img src="{{ asset('imgs/footer_logo.png') }}" alt="logo">
            </button>
            <div class="sidebar-logo">
              <a href="{{ route('admin.index') }}">FANZONE</a>
            </div>
          </div>
          <ul class="sidebar-nav">
            <li class="sidebar-item">
              <form action="{{ route('admin.index') }}">
                <button class="sidebar-link" type="submit">
                  <i class="fa-solid fa-house"></i>
                  <span> Dashboard</span>
                </button>
              </form>
            </li>

            <li class="sidebar-item">
              <form action="{{ route('admin.displayFan') }}" method="GET">
                {{-- @csrf
                @method('PUT') --}}
                <button class="sidebar-link" type="submit">
                  <i class="fa-solid fa-people-group"></i>
                  <span>Manage Fans</span>
                </button>
              </form>
            </li>

            <li class="sidebar-item">
              <form action="{{ route('admin.getEmployees') }}">
                <button class="sidebar-link">
                  <i class="fa-solid fa-user-tie"></i>
                  <span>Manage Employees</span>
                </button>
              </form>
            </li>

            <li class="sidebar-item">
                <a
                  href=""
                  class="sidebar-link collapsed has-dropdown"
                  data-bs-toggle="collapse"
                  data-bs-target="#trans"
                  aria-expanded="false"
                  aria-controls="trans">
                  <i class="fa-solid fa-bus"></i>
                  <span>Manage Transportation</span>
                </a>
                <ul
                  id="trans"
                  class="sidebar-dropdown list-unstyled collapse"
                  data-bs-parent="#sidebar">
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayBuses') }}">
                      <button class="sidebar-link">Buses</button>
                    </form>
                  </li>
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayStations') }}">
                      <button class="sidebar-link" type="submit">Stations</button>
                    </form>
                  </li>
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayTrips') }}">
                      <button class="sidebar-link" type="submit">Trips</button>
                    </form>
                  </li>
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayprices') }}">
                      <button class="sidebar-link" type="submit">Trip prices</button>
                    </form>
                  </li>
                </ul>
    </li>

            <li class="sidebar-item">
              <a
                href=""
                class="sidebar-link collapsed has-dropdown"
                data-bs-toggle="collapse"
                data-bs-target="#games"
                aria-expanded="false"
                aria-controls="games">
                <i class="fa-solid fa-futbol"></i>
                <span>Manage Games</span>
              </a>
              <ul
                id="games"
                class="sidebar-dropdown list-unstyled collapse"
                data-bs-parent="#sidebar">
                <li class="sidebar-item">
                  <form action="{{ route('admin.displayTeams') }}">
                    <button class="sidebar-link">
                      Teams
                    </button>
                  </form>
                </li>
                <li class="sidebar-item">
                  <form action="{{ route('admin.displayStadium') }}">
                    <button class="sidebar-link">
                     Stadiums
                    </button>
                  </form>
                </li>
                <li class="sidebar-item">
                  <form action="{{ route('admin.displayComptition') }}">
                    <button class="sidebar-link" type="submit">
                     Competitions
                    </button>
                  </form>
                </li>
              </ul>
            </li>

            <li class="sidebar-item">
                <a
                  href=""
                  class="sidebar-link collapsed has-dropdown"
                  data-bs-toggle="collapse"
                  data-bs-target="#restore"
                  aria-expanded="false"
                  aria-controls="restore">
                  <i class="fa-solid fa-repeat"></i>
                <span>Restore the deactive</span>
                </a>
                <ul
                  id="restore"
                  class="sidebar-dropdown list-unstyled collapse"
                  data-bs-parent="#sidebar">
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayDeactiveEmployee') }}">
                      <button class="sidebar-link">Deactive employees</button>
                    </form>
                  </li>
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayDeactiveBuses') }}">
                      <button class="sidebar-link" type="submit">Deactive buses</button>
                    </form>
                  </li>
                  <li class="sidebar-item">
                    <form action="{{ route('admin.displayDeactiveStations') }}">
                      <button class="sidebar-link" type="submit">Deactive station</button>
                    </form>
                  </li>
                </ul>
    </li>
    <li class="sidebar-item">
        <form action="{{ route('admin.displayRegex') }}" method="GET">
          {{-- @csrf
          @method('PUT') --}}
          <button class="sidebar-link" type="submit">
            <i class="fa-solid fa-passport"></i>
                    <span>Passport number regex</span>
          </button>
        </form>
      </li>
          </ul>
          <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="adminLogout" type="submit">
                    <a class="sidebar-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </button>
            </form>
        </div>
        </aside>

        <div class="contandnav">
            <nav class="navbar bg-body-tertiary  admin_nav">
                <div class="container-fluid justify-content-end pe-5">
                    <img src="{{ asset('imgs/employees_pictures/'. Auth::guard('employee')->user()->personal_image) }}" alt="employee">
                    <span class="admin-name fw-semibold">{{ Auth::guard('employee')->user()->name }}</span>
                </div>
            </nav>

            @yield('content')

    </div>






    <script>
        const hamBurger = document.querySelector(".toggle-btn-admin");

        hamBurger.addEventListener("click", function () {
          document.querySelector("#sidebar").classList.toggle("expand");
        });
        //-search- func--
        document
          .getElementById("searchInput")
          .addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll("#dataTable tbody tr");

            tableRows.forEach((row) => {
              const id = row.cells[0].textContent.toLowerCase();
              const name = row.cells[1].textContent.toLowerCase();
              const tickId = row.cells[2].textContent.toLowerCase();

              if (name.includes(searchTerm) || id.includes(searchTerm) || tickId.includes(searchTerm)){
                row.style.display = "";
              } else {
                row.style.display = "none";
              }
            });
          });



      </script>
     <!-- script files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')
    <!-- script files -->
    </body>
    </html>








