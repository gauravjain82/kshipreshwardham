@extends('layouts.app')

@section('title', 'Photo Gallery')

@push('styles')
<style>
    .gallery-wrapper {
        padding: 80px 0 100px;
        background: var(--cream);
        min-height: 60vh;
    }
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 48px;
    }
    .filter-btn {
        padding: 10px 26px;
        border-radius: 30px;
        font-family: 'Cinzel', serif;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        cursor: pointer;
        border: 2px solid var(--gold);
        background: transparent;
        color: var(--crimson);
        transition: all 0.25s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--crimson);
        border-color: var(--crimson);
        color: var(--gold-light);
    }
    .gallery-masonry {
        columns: 3;
        column-gap: 18px;
    }
    .gallery-masonry-item {
        break-inside: avoid;
        margin-bottom: 18px;
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
    }
    .gallery-masonry-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }
    .gallery-masonry-item:hover img { transform: scale(1.06); }
    .gal-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(61,0,0,0.85) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.35s;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }
    .gal-overlay-inner { width: 100%; }
    .gal-title {
        font-family: 'Cinzel', serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gold-light);
        letter-spacing: 0.05em;
    }
    .gal-cat {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.9rem;
        color: rgba(245,200,66,0.65);
        font-style: italic;
    }
    .gal-zoom {
        position: absolute;
        top: 16px; right: 16px;
        width: 36px; height: 36px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 0.85rem;
        backdrop-filter: blur(4px);
        opacity: 0;
        transition: opacity 0.35s, transform 0.35s;
        transform: translateY(-8px);
    }
    .gallery-masonry-item:hover .gal-overlay { opacity: 1; }
    .gallery-masonry-item:hover .gal-zoom {
        opacity: 1;
        transform: translateY(0);
    }
    /* Placeholder tiles */
    .gal-placeholder {
        background: linear-gradient(135deg, var(--crimson-dark), var(--crimson));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        min-height: 200px;
    }
    .gal-placeholder.tall { min-height: 340px; }

    /* Lightbox */
    .lightbox {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.94);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }
    .lightbox.open { display: flex; }
    .lightbox-inner {
        position: relative;
        max-width: 900px;
        width: 100%;
        text-align: center;
    }
    .lightbox-img {
        max-width: 100%;
        max-height: 75vh;
        border-radius: 8px;
        box-shadow: 0 0 80px rgba(212,160,23,0.3);
    }
    .lightbox-close {
        position: absolute;
        top: -48px; right: 0;
        background: none; border: none;
        color: var(--gold-light);
        font-size: 1.8rem;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .lightbox-close:hover { transform: rotate(90deg); }
    .lightbox-caption {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        color: rgba(245,230,200,0.7);
        font-size: 1.1rem;
        margin-top: 16px;
    }

    @media (max-width: 768px) {
        .gallery-masonry { columns: 2; }
    }
    @media (max-width: 480px) {
        .gallery-masonry { columns: 1; }
    }
</style>
@endpush

@section('content')

<div class="page-banner">
    <h1>Photo Gallery</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fas fa-chevron-right"></i>
        <span>Gallery</span>
    </div>
</div>

<div class="gallery-wrapper">
    <div class="container">
        <div class="filter-bar">
            <button class="filter-btn active" data-filter="all">All Photos</button>
            <button class="filter-btn" data-filter="temple">Temple</button>
            <button class="filter-btn" data-filter="aarti">Aarti</button>
            <button class="filter-btn" data-filter="festival">Festivals</button>
            <button class="filter-btn" data-filter="prasad">Prasad</button>
            <button class="filter-btn" data-filter="nature">Nature</button>
        </div>

        @if($images->count())
        <div class="gallery-masonry" id="galleryGrid">
            @foreach($images as $image)
            <div class="gallery-masonry-item" data-cat="{{ $image->category }}" onclick="openLightbox('{{ $image->image_url }}','{{ $image->title }}')">
                <img src="{{ $image->image_url }}" alt="{{ $image->title }}" loading="lazy">
                <div class="gal-overlay">
                    <i class="fas fa-search-plus gal-zoom"></i>
                    <div class="gal-overlay-inner">
                        <div class="gal-title">{{ $image->title }}</div>
                        <div class="gal-cat">{{ ucfirst($image->category) }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        {{-- Demo tiles when no DB data --}}
        <div class="gallery-masonry" id="galleryGrid">
            @php
            $tiles = [
                ['🕉','temple','Temple Entrance','tall'],
                ['🪔','aarti','Evening Aarti',''],
                ['🌸','festival','Navratri Celebration',''],
                ['🔱','temple','Shivalinga Abhishek','tall'],
                ['🌺','prasad','Sacred Prasad',''],
                ['🏛','temple','Ancient Architecture',''],
                ['🎊','festival','Mahashivratri Night','tall'],
                ['🌿','nature','Temple Garden',''],
                ['📿','aarti','Morning Prayers',''],
            ];
            @endphp
            @foreach($tiles as $tile)
            <div class="gallery-masonry-item" data-cat="{{ $tile[1] }}" onclick="openLightbox('','{{ $tile[2] }}')">
                <div class="gal-placeholder {{ $tile[3] }}">{{ $tile[0] }}</div>
                <div class="gal-overlay">
                    <i class="fas fa-search-plus gal-zoom"></i>
                    <div class="gal-overlay-inner">
                        <div class="gal-title">{{ $tile[2] }}</div>
                        <div class="gal-cat">{{ ucfirst($tile[1]) }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <div class="lightbox-inner" onclick="event.stopPropagation()">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
        <img class="lightbox-img" src="" id="lightboxImg" alt="">
        <p class="lightbox-caption" id="lightboxCaption"></p>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.gallery-masonry-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            items.forEach(item => {
                if(filter === 'all' || item.dataset.cat === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Lightbox
    function openLightbox(src, caption) {
        const lb = document.getElementById('lightbox');
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightboxCaption').textContent = caption;
        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if(e.key === 'Escape') closeLightbox();
    });
</script>
@endpush
