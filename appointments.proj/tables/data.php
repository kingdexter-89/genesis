<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Appointments</title>

  <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
  <script>
    (() => {
      'use strict';
      const root = document.documentElement;

      // Applications with their own theming opt out of AdminLTE's color mode
      // entirely, here as well as in the bundle.
      if (root.getAttribute('data-lte-color-mode') === 'off') {
        return;
      }

      const STORAGE_KEY = 'lte-theme';
      let stored = null;
      try {
        stored = localStorage.getItem(STORAGE_KEY);
      } catch {
        // localStorage may be unavailable (private mode, sandboxed iframe).
      }
      // Mirror the precedence in color-mode.ts: the visitor's stored choice
      // wins, then a theme this page declared itself, then the OS preference.
      const authored = root.getAttribute('data-bs-theme');
      let resolved = 'light';
      if (stored === 'dark' || stored === 'light') {
        resolved = stored;
      } else if (authored === 'dark' || authored === 'light') {
        resolved = authored;
      } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
        resolved = 'dark';
      }
      root.setAttribute('data-bs-theme', resolved);
      root.style.colorScheme = resolved;
      // Flag values computed here, so the bundle does not mistake them for a
      // theme the page declared and stop following the OS preference.
      if (resolved !== authored) {
        root.setAttribute('data-lte-theme-resolved', '');
      }
    })();
  </script>
  <!--end::Theme Init-->

  <!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <!--end::Accessibility Meta Tags-->

  <!--begin::Primary Meta Tags-->
  <meta name="title" content="AdminLTE 4 | Data Tables" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description"
    content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel" />
  <!--end::Primary Meta Tags-->

  <!--begin::Accessibility Features-->
  <!-- Skip links will be dynamically added by accessibility.js -->
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="C:\xampp\htdocs\appointments.proj\css\adminlte.css" as="style" />
  <!--end::Accessibility Features-->

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media = 'all'" />
  <!--end::Fonts-->

  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="../css/adminlte.css" />
  <!--end::Required Plugin(AdminLTE)-->

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css"
    crossorigin="anonymous" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle sidebar">
              <i class="bi bi-list"></i>
            </a>
          </li>

        </ul>
        <!--end::Start Navbar Links-->

          <!--begin::Language Menu-->
          <!-- Markup only: swapping the locale is the application's job. The docs
          Recipes page shows how to wire this to a real locale switch. -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="language-menu" data-bs-toggle="dropdown" aria-expanded="false"
              aria-label="Change language, current language English">
              <i class="bi bi-translate" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="language-menu">
              <li>
                <a class="dropdown-item active" href="#" hreflang="en" aria-current="true">
                  English
                  <i class="bi bi-check-lg ms-2" aria-hidden="true"></i>
                </a>
              </li>
              <li><a class="dropdown-item" href="#" hreflang="es">Español</a></li>
              <li><a class="dropdown-item" href="#" hreflang="fr">Français</a></li>
              <li><a class="dropdown-item" href="#" hreflang="de">Deutsch</a></li>
              <li><a class="dropdown-item" href="#" hreflang="ar">العربية</a></li>
            </ul>
          </li>
          <!--end::Language Menu-->

          <!--begin::Fullscreen Toggle-->
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen" aria-label="Toggle fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
            </a>
          </li>
          <!--end::Fullscreen Toggle-->

          <!--begin::Color Mode Toggle (#6010)-->
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
              <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
              <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme"
              style="--bs-dropdown-min-width: 8rem">
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                  aria-pressed="false">
                  <i class="bi bi-sun-fill me-2"></i>
                  Light
                  <i class="bi bi-check-lg ms-auto d-none"></i>
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                  aria-pressed="false">
                  <i class="bi bi-moon-fill me-2"></i>
                  Dark
                  <i class="bi bi-check-lg ms-auto d-none"></i>
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                  aria-pressed="true">
                  <i class="bi bi-circle-half me-2"></i>
                  Auto
                  <i class="bi bi-check-lg ms-auto d-none"></i>
                </button>
              </li>
            </ul>
          </li>
          <!--end::Color Mode Toggle-->
            </ul>
          </li>
          <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
          <!--begin::Brand Text-->
          <span class="brand-text fw-light">Hospital</span>
          <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
          <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
            <li class="nav-item">
              <a href="/appointments.proj/index2.html" class="nav-link">
                <i class="nav-icon bi bi-file-earmark"></i>
                <p>Starter Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/appointments.proj/forms/advanced.php" class="nav-link">
                <i class="nav-icon bi bi-pencil-square"></i>
                <p>Scheduled Clients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="editclient.php" class="nav-link">
                <i class="nav-icon bi bi-pencil-square"></i>
                <p>Edit Clients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/appointments.proj/tables/data.php" class="nav-link">
                <i class="nav-icon bi bi-table"></i>
                <p>Scheduled Attendants</p>
              </a>
            </li>
          </ul>
          <!--end::Sidebar Menu-->
    </aside>
    <!--end::Sidebar-->
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="mb-0 fs-3">Attendants</h1>
            </div>
            <div class="col-sm-6">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Attendants</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Attendants for clients</h3>
            </div>
            <div class="card-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>ATTENDANT</th>
                  <th>SERVICE</th>
                  <th>WARD</th>
                  <th>TIME</th>
                  <th>
                    <button class="btn btn-sm btn-outline-secondary">VIEW</button>
                    <button class="btn btn-sm btn-outline-secondary">EDIT</button>
                    <button class="btn btn-sm btn-outline-secondary">DELETE</button>
                  </th>                  
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--begin::Footer-->
  </div>
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="../js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)-->
  <!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

      // Disable OverlayScrollbars on mobile devices to prevent touch interference
      const isMobile = window.innerWidth <= 992;

      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
        !isMobile
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure-->

  <!--begin::Color Mode Toggle-->
  <!-- The light/dark/auto switcher ships in adminlte.js as the ColorMode
     module (since 4.1) — no page script needed. Only the no-flash snippet
     in <head> stays inline, because it must run before first paint. -->
  <!--end::Color Mode Toggle-->

  <script src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/js/tabulator.min.js"
    crossorigin="anonymous"></script>
  <script>
    const statusBadge = (cell) => {
      const value = cell.getValue();
      const map = { Active: 'success', Invited: 'info', Suspended: 'secondary' };
      const color = map[value] || 'secondary';
      return `<span class="badge text-bg-${color}">${value}</span>`;
    };

    document.addEventListener('DOMContentLoaded', () => {
      const data = [
        {
          id: 1,
          name: 'Olivia Bennett',
          email: 'olivia@example.com',
          role: 'Admin',
          status: 'Active',
          joined: '2024-03-12',
        },
        {
          id: 2,
          name: 'Liam Carter',
          email: 'liam@example.com',
          role: 'Editor',
          status: 'Active',
          joined: '2024-04-08',
        },
        {
          id: 3,
          name: 'Emma Dawson',
          email: 'emma@example.com',
          role: 'Viewer',
          status: 'Invited',
          joined: '2024-06-21',
        },
        {
          id: 4,
          name: 'Noah Evans',
          email: 'noah@example.com',
          role: 'Editor',
          status: 'Suspended',
          joined: '2024-07-15',
        },
        {
          id: 5,
          name: 'Ava Foster',
          email: 'ava@example.com',
          role: 'Admin',
          status: 'Active',
          joined: '2024-08-30',
        },
        {
          id: 6,
          name: 'Ethan Grant',
          email: 'ethan@example.com',
          role: 'Viewer',
          status: 'Active',
          joined: '2024-09-14',
        },
        {
          id: 7,
          name: 'Sophia Hayes',
          email: 'sophia@example.com',
          role: 'Editor',
          status: 'Active',
          joined: '2024-10-02',
        },
        {
          id: 8,
          name: 'Mason Ingram',
          email: 'mason@example.com',
          role: 'Viewer',
          status: 'Invited',
          joined: '2024-11-19',
        },
        {
          id: 9,
          name: 'Isabella Jones',
          email: 'isabella@example.com',
          role: 'Admin',
          status: 'Active',
          joined: '2025-01-05',
        },
        {
          id: 10,
          name: 'Lucas Klein',
          email: 'lucas@example.com',
          role: 'Viewer',
          status: 'Suspended',
          joined: '2025-02-18',
        },
        {
          id: 11,
          name: 'Mia Lopez',
          email: 'mia@example.com',
          role: 'Editor',
          status: 'Active',
          joined: '2025-03-22',
        },
        {
          id: 12,
          name: 'Logan Moore',
          email: 'logan@example.com',
          role: 'Viewer',
          status: 'Active',
          joined: '2025-04-09',
        },
        {
          id: 13,
          name: 'Charlotte Nelson',
          email: 'charlotte@example.com',
          role: 'Admin',
          status: 'Active',
          joined: '2025-04-27',
        },
        {
          id: 14,
          name: 'Henry Owens',
          email: 'henry@example.com',
          role: 'Editor',
          status: 'Invited',
          joined: '2025-05-11',
        },
        {
          id: 15,
          name: 'Amelia Price',
          email: 'amelia@example.com',
          role: 'Viewer',
          status: 'Active',
          joined: '2025-05-17',
        },
      ];

      const table = new Tabulator('#users-table', {
        data: data,
        layout: 'fitColumns',
        pagination: true,
        paginationSize: 10,
        paginationSizeSelector: [10, 25, 50, 100],
        movableColumns: true,
        columns: [
          { title: '#', field: 'id', width: 60, headerSort: true },
          { title: 'Name', field: 'name', headerFilter: 'input' },
          { title: 'Email', field: 'email', headerFilter: 'input' },
          {
            title: 'Role',
            field: 'role',
            headerFilter: 'list',
            headerFilterParams: { values: ['', 'Admin', 'Editor', 'Viewer'] },
            width: 120,
          },
          {
            title: 'Status',
            field: 'status',
            formatter: statusBadge,
            headerFilter: 'list',
            headerFilterParams: { values: ['', 'Active', 'Invited', 'Suspended'] },
            width: 130,
            hozAlign: 'center',
          },
          { title: 'Joined', field: 'joined', sorter: 'date', width: 130 },
        ],
      });

      document.getElementById('table-filter').addEventListener('input', (e) => {
        const value = e.target.value;
        if (value) {
          table.setFilter([
            [
              { field: 'name', type: 'like', value: value },
              { field: 'email', type: 'like', value: value },
            ],
          ]);
        } else {
          table.clearFilter();
        }
      });

      document
        .getElementById('export-csv')
        .addEventListener('click', () => table.download('csv', 'users.csv'));
      document
        .getElementById('export-json')
        .addEventListener('click', () => table.download('json', 'users.json'));
      document
        .getElementById('print-table')
        .addEventListener('click', () => table.print(false, true));
    });
  </script>
</body>

</html>