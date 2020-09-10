<?php
if (!isset($_SESSION["name"]))
{
    header("Location: /adminpanel/admin/");
}

?>

<style>

html, body
{
  overflow-x: hidden; /* Prevent scroll on narrow devices */
}

body
{
  padding-top: 56px;
}

@media (max-width: 991.98px)
{
  .offcanvas-collapse
  {
    position: fixed;
    top: 56px; /* Height of navbar */
    bottom: 0;
    left: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #343a40;
    transition: visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
  }

  .offcanvas-collapse.open
  {
    visibility: visible;
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
  }
}

.nav-scroller
{
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav
{
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  color: rgba(255, 255, 255, .75);
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-underline .nav-link
{
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
  color: #6c757d;
}

.nav-underline .nav-link:hover 
{
  color: #007bff;
}

.nav-underline .active
{
  font-weight: 500;
  color: #343a40;
}

.text-white-50
{
  color: rgba(255, 255, 255, .5);
}

.bg-purple
{
  background-color: #6f42c1;
}

.lh-100
{
  line-height: 1;
}

.lh-125
{
  line-height: 1.25;
}

.lh-150
{
  line-height: 1.5;
}
</style>

<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
  <img class="mr-3" src="" alt="" width="48" height="48">
  <div class="lh-100">
    <h6 class="mb-0 text-white">Beérkező cégalapítási kérelmek</h6>
  </div>
</div>

<div class="my-3 p-3 bg-white rounded shadow-sm">

<?php
foreach ($mainData as $data)
{
  echo '
  <div class="media text-muted pt-3">
    <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      Új cégalapítási kérelem! Cég neve: ' . $data["company_name"] . '
    </p>
    <form class="media-body" action="/adminpanel/admin/company" method="post">
        <button class="mb-0 btn btn-primary submit-btn lh-100" type="submit">Kezelés</button>
        <input type="hidden" name="company_name" value="' . $data["company_name"] . '">
        <input type="hidden" name="review_by" value="' . $_SESSION["name"] . '">
    </form>
  </div>
  ';
}

?>
  <small class="d-block text-right mt-3">
    <a href="/adminpanel/admin/home">Frissítés</a>
  </small>
</div>

<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
  <img class="mr-3" src="" alt="" width="48" height="48">
  <div class="lh-100">
    <h6 class="mb-0 text-white">Az általad kezelt cégalapítási kérelmek</h6>
  </div>
</div>

<div class="my-3 p-3 bg-white rounded shadow-sm">

<?php

if ($mainData2 != 0)
{
  foreach ($mainData2 as $data)
  {
    echo '
      <div class="media text-muted pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          Ez a kérelem a te elbírálásodra vár! Cég neve: ' . $data["company_name"] . '
        </p>
        <form class="media-body" action="/adminpanel/admin/company" method="post">
            <button class="mb-0 btn btn-primary submit-btn lh-100" type="submit">Kezelés</button>
            <input type="hidden" name="company_name" value="' . $data["company_name"] . '">
            <input type="hidden" name="review_by" value="' . $_SESSION["name"] . '">
        </form>
      </div>
    ';
  }
}
else
{
  echo '
      <div class="media text-muted pt-3">
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">Nincsen kérelem ami rád vár feldolgozásra!</p>
      </div>
  ';
}

?>
</div>