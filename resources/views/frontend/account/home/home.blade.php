@extends('frontend.account.components.body-login')

@section('title', 'Home|EduardSearch')

@section('custom-header')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <aside class="sidebar">
      <nav>
        <ul>
          <li><a href="#">Recommendations</a></li>
          <li><a href="#">New Releases</a></li>
          <li><a href="#">Top Charts</a></li>
          <li><a href="#">Radio</a></li>
          <li><a href="#">Feed</a></li>
        </ul>
        <button class="new-playlist">New Playlist</button>
        <ul>
          <li><a href="#">Top Charts Compilation</a></li>
          <li><a href="#">This is Angry</a></li>
          <li><a href="#">Best of Mine</a></li>
          <li><a href="#">Best of Christmas Hits</a></li>
        </ul>
      </nav>
    </aside>
    <main class="content">
      <header class="header">
        <h1>José Carreras</h1>
        <h2>Bel Canto</h2>
        <button class="play-btn">Play</button>
      </header>
      <section class="albums">
        <div class="album">
          <img src="https://via.placeholder.com/150" alt="Album Art">
          <div class="album-info">
            <h3>Awake</h3>
            <p>José Carreras</p>
            <span>8:04</span>
          </div>
        </div>
        <div class="album">
          <img src="https://via.placeholder.com/150" alt="Album Art">
          <div class="album-info">
            <h3>Best Day</h3>
            <p>Mac Miller</p>
            <span>3:55</span>
          </div>
        </div>
        <div class="album">
          <img src="https://via.placeholder.com/150" alt="Album Art">
          <div class="album-info">
            <h3>Beautiful</h3>
            <p>Eminem</p>
            <span>5:36</span>
          </div>
        </div>
      </section>
      <section class="popular">
        <h2>Popular</h2>
        <div class="popular-albums">
          <div class="popular-album">
            <img src="https://via.placeholder.com/100" alt="Popular Album Art">
            <p>Rihanna</p>
          </div>
          <div class="popular-album">
            <img src="https://via.placeholder.com/100" alt="Popular Album Art">
            <p>Eminem</p>
          </div>
          <div class="popular-album">
            <img src="https://via.placeholder.com/100" alt="Popular Album Art">
            <p>Mac Miller</p>
          </div>
          <div class="popular-album">
            <img src="https://via.placeholder.com/100" alt="Popular Album Art">
            <p>Kendrick Lamar</p>
          </div>
        </div>
      </section>
    </main>
  </div>
  <footer class="footer">
    <div class="current-track">
      <img src="https://via.placeholder.com/50" alt="Current Track Art">
      <div class="track-info">
        <p>Grunt 15</p>
        <p>YouTube</p>
      </div>
    </div>
    <div class="controls">
      <button class="prev-btn">Prev</button>
      <button class="play-pause-btn">Play/Pause</button>
      <button class="next-btn">Next</button>
    </div>
    <div class="progress-bar">
      <input type="range" min="0" max="100" value="50">
    </div>
  </footer>
@endsection

@section('custom-footer')
    <script src="{{ asset('js/home/eduard-search.js') }}"></script>
@endsection