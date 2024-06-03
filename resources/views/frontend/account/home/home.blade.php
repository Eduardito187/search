@extends('frontend.account.components.body-login')

@section('title', 'Home|EduardSearch')

@section('custom-header')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home/eduard-search.js') }}"></script>
@endsection

@section('content')
<div class="container-screen" id="home-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <img src="https://via.placeholder.com/50" alt="Logo" class="logo">
        <span class="brand" v-if="customer != null">{{customer.first_name}}</span>
      </div>
      <div class="search">
        <input type="text" placeholder="Search">
      </div>
      <nav class="menu">
        <ul>
          <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
          <li><a href="#"><i class="fa fa-th"></i> Overview</a></li>
          <li><a href="#"><i class="fa fa-comment-alt"></i> Comments <span class="badge">3</span></a></li>
          <li><a href="#"><i class="fa fa-calendar-alt"></i> Calendar</a></li>
          <li class="submenu">
            <a href="#">
                <i class="fa fa-folder"></i> 
                Projects 
                <i class="fa fa-chevron-down"></i>
            </a>
            <ul>
              <li><a href="#">Project 1</a></li>
              <li><a href="#">Project 2</a></li>
              <li><a href="#">Project 3</a></li>
            </ul>
          </li>
          <li><a href="#"><i class="fa fa-chart-bar"></i> Analytics</a></li>
          <li><a href="#"><i class="fa fa-star"></i> Starred</a></li>
          <li><a href="#"><i class="fa fa-user"></i> User</a></li>
          <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
        </ul>
      </nav>
    </aside>
    <main class="content">
      <header>
        <h1>My Dashboard</h1>
      </header>
      <section class="dashboard-content">
        <!-- Dashboard content goes here -->
      </section>
    </main>
  </div>
@endsection

@section('custom-footer')
@endsection