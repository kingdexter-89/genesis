<?php
$conn = new mysqli("localhost", "root", "", "hospital");

if ($conn->connect_error) {
    die("Database connection failed");}
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

          $name = $_POST['name'] ?? "";
          $email = $_POST['email'] ?? "";
          $phone = $_POST['phone'] ?? "";
          $service = trim($_POST['service'] ?? "");
          $attendant = trim($_POST['attendant'] ?? "");
          $ward = trim($_POST['ward'] ?? "");
          $time = $_POST['time'] ?? "";

          $allowedServices = ["Dental","Physiotherapy","Blood Test","Check Up","Optical","SKin Care"];

          if (!$id || $name === "" ||
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                !in_array($service, $allowedServices, true)) {
                  die("invalid details");}
          $stmt = $conn->prepare(
            "UPDATE Clients SET name = ?, email = ?, phone = ?, sesrvice = ?, attendant = ?, ward = ?, time = ?
            WHERE id = ?");

            $stmt->bind_param(
              "sssssssi",
              $name, $email, $phone, $service, $attendant, $ward, $time, $id);

          if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

          header("Location: advanced.php");
          exit;}
          die("Unable to update client");}
if (!$id) {die("invalid client ID");}
$stmt = conn->prepare( "SELECT name, email,phone,service FROM Clients WHERE id=?");

$stmt->bond_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $service, $attendant, $ward, $time, $id);

if (!$stmt->fetch()) {die("Client not found");}
$stmt->close();
?>

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
  <meta name="title" content="AdminLTE 4 | Advanced Form Elements" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description"
    content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel" />
  <!--end::Primary Meta Tags-->

  <!--begin::Accessibility Features-->
  <!-- Skip links will be dynamically added by accessibility.js -->
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="../css/adminlte.css" as="style" />
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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.6.1/dist/css/tom-select.bootstrap5.min.css"
    integrity="sha384-qNqaCnsmyTrYVwmqv4/4PcwMK8ZFAQnYPpVjWor+6cX6rKsPhebzu8vO2J3s+VZg" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css"
    integrity="sha384-RkASv+6KfBMW9eknReJIJ6b3UnjKOKC5bOUaNgIY778NFbQ8MtWq9Lr/khUgqtTt" crossorigin="anonymous" />
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
        <!--begin::Brand Link-->
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
              <h1 class="mb-0 fs-3">Clients</h1>
            </div>
            <div class="col-sm-6">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Clients</a></li>
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
              <h3 class="card-title">Editing Clients</h3>
            </div>
            <div class="card-body">
              <form action="admin.php" method="post">
                <table class="table table-striped table-hover">
                  <tr>
                    <td>NAME:</td>
                    <td>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" required
                      value="<?=htmlspecialchars($name) ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>EMAIL:</td>
                    <td>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required
                      value="<?=htmlspecialchars($email) ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>PHONE NUMBER:</td>
                    <td>
                      <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" required
                      value="<?=htmlspecialchars($phone) ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>SERVICE:</td>
                    <td>
                      <select id="footer-color-modes" class="form-control" name="service" required
                      aria-label="Single select with search">
                        <option value="Dental" <?= $service === "Dental" ? "selected" : "" ?>>Dental</option>
                        <option value="Physiotherapy" <?= $service === "Physiotherapy" ? "selected" : "" ?>>Physiotherapy</option>
                        <option value="Optical" <?= $service === "Optical" ? "selected" : "" ?>>Optical</option>
                        <option value="Check Up" <?= $service === "Check Up" ? "selected" : "" ?>>Check Up</option>
                        <option value="Blood Test" <?= $service === "Blood Test" ? "selected" : "" ?>>Blood Test</option>
                        <option value="Skin Care" <?= $service === "Skin Care" ? "selected" : "" ?>>Skin Care</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="advanced.php"><button class="btn btn-sm btn-outline-secondary" type="reser" name="reset">CANCEL & RETURN</button></a>
                      <button class="btn btn-sm btn-outline-secondary" type="submit" name="submit">SAVE CHANGES</button>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
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

  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.6.1/dist/js/tom-select.complete.min.js"
    integrity="sha384-OgdLxftmuTHirLYFRbvXsKJxgSVqpU4ZdZ07tRiBC+Z4GjtQ5Al0uika0gtMfeQw"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"
    integrity="sha384-5JqMv4L/Xa0hfvtF06qboNdhvuYXUku9ZrhZh3bSk8VXF0A/RuSLHpLsSV9Zqhl6"
    crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Tom Select: single select with search and a clear button
      new TomSelect('#country', {
        plugins: ['clear_button'],
        sortField: { field: 'text', direction: 'asc' },
      });

      // Tom Select: multi-select with removable tags (type to add new ones)
      new TomSelect('#post-tags', {
        plugins: ['remove_button'],
        create: true,
        persist: false,
      });

      // Tom Select: remote data, the way you'd wire a select backed by a table
      // with thousands of rows. Only the matching page is ever loaded.
      const PAGE_SIZE = 12;
      const FIRST_NAMES = [
        'Olivia',
        'Liam',
        'Emma',
        'Noah',
        'Ava',
        'Ethan',
        'Sofia',
        'Lucas',
        'Mia',
        'Mateo',
        'Isla',
        'Arjun',
        'Nora',
        'Hugo',
        'Yuki',
        'Amara',
        'Elena',
        'Omar',
        'Freya',
        'Diego',
        'Leila',
        'Jonas',
        'Priya',
        'Marek',
      ];
      const TEAMS = ['Frontend', 'Backend', 'Design'];
      // Stands in for a database table.
      const REVIEWERS = FIRST_NAMES.flatMap((first, index) =>
        ['Bennett', 'Carter', 'Dawson'].map((last, offset) => ({
          id: index * 3 + offset + 1,
          name: `${first} ${last}`,
          team: TEAMS[(index + offset) % TEAMS.length],
        })),
      );

      // Stand-in for a real endpoint. To go live, replace the whole body with:
      //   return fetch(url, { signal }).then((response) => response.json())
      // The { results, next } response shape is what the loader below expects
      // — and it's the same shape Select2's `ajax.processResults` users return.
      function fetchReviewers(url, signal) {
        const params = new URLSearchParams(url.slice(url.indexOf('?') + 1));
        const query = (params.get('q') || '').toLowerCase();
        const page = Number(params.get('page') || 1);

        return new Promise((resolve, reject) => {
          const timer = setTimeout(() => {
            const matches = REVIEWERS.filter((person) =>
              `${person.name} ${person.team}`.toLowerCase().includes(query),
            );
            const start = (page - 1) * PAGE_SIZE;
            const hasMore = start + PAGE_SIZE < matches.length;
            resolve({
              results: matches.slice(start, start + PAGE_SIZE),
              next: hasMore
                ? `/api/reviewers?q=${encodeURIComponent(query)}&page=${page + 1}`
                : null,
            });
          }, 400);

          signal.addEventListener('abort', () => {
            clearTimeout(timer);
            reject(new DOMException('Aborted', 'AbortError'));
          });
        });
      }

      let inFlight = null;

      new TomSelect('#reviewer', {
        valueField: 'id',
        labelField: 'name',
        searchField: ['name', 'team'],
        placeholder: 'Type to search 72 people…',
        preload: 'focus',
        // Tom Select debounces `load` for you — no hand-rolled timer needed.
        loadThrottle: 300,
        // Pages in the next batch when the dropdown is scrolled to the bottom.
        plugins: ['virtual_scroll'],
        firstUrl: (query) => `/api/reviewers?q=${encodeURIComponent(query)}&page=1`,
        // Tom Select invokes `load` with the instance as `this`; that's how
        // the virtual_scroll plugin hands over getUrl() and setNextUrl().
        /* eslint-disable unicorn/no-this-outside-of-class */
        async load(query, callback) {
          // Cancel the request already in flight, so a slow response for "an"
          // can't land after the fast one for "anna".
          if (inFlight) {
            inFlight.abort();
          }
          inFlight = new AbortController();

          try {
            const json = await fetchReviewers(this.getUrl(query), inFlight.signal);
            if (json.next) {
              this.setNextUrl(query, json.next);
            }
            callback(json.results);
          } catch (error) {
            // An aborted request was replaced by a newer one — let that one
            // resolve the dropdown instead of clearing it here.
            if (error.name !== 'AbortError') {
              callback();
            }
          }
        },
        /* eslint-enable unicorn/no-this-outside-of-class */
        render: {
          option: (data, escape) =>
            `<div class="d-flex justify-content-between align-items-center">
                 <span>${escape(data.name)}</span>
                 <span class="badge text-bg-secondary">${escape(data.team)}</span>
               </div>`,
          loading_more: () => '<div class="p-2 text-body-secondary small">Loading more…</div>',
          no_more_results: () =>
            '<div class="p-2 text-body-secondary small">End of results</div>',
        },
      });

      // Flatpickr: date picker
      flatpickr('#delivery-date', {
        dateFormat: 'Y-m-d',
      });

      // Flatpickr: date & time picker
      flatpickr('#meeting-start', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
      });

      // Flatpickr: range picker
      flatpickr('#report-period', {
        mode: 'range',
        dateFormat: 'Y-m-d',
      });

      // Flatpickr: time-only picker
      flatpickr('#reminder-time', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
      });
    });
  </script>
</body>

</html>