<?php 
include "DB_connection.php";
include "data/setting.php";
$setting = getSetting($conn);
 
if ($setting != 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to <?=$setting['school_name']?></title>
    <link rel="icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
 
        :root {
            --navy:   #0b1628;
            --navy2:  #112040;
            --navy3:  #1a3060;
            --gold:   #c9a84c;
            --gold2:  #e8c97a;
            --cream:  #f7f3ec;
            --cream2: #ede8df;
            --text:   #1a1a2e;
            --muted:  #6b7a99;
            --white:  #ffffff;
            --border: rgba(201,168,76,0.2);
        }
 
        html { scroll-behavior: smooth; }
 
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
            overflow-x: hidden;
        }
 
        /* ── NAVBAR ─────────────────────────────── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 18px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background .35s, box-shadow .35s;
        }
        .navbar.scrolled {
            background: rgba(11,22,40,0.97);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 0 rgba(201,168,76,0.15);
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 8px;
        }
        .nav-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            display: none;
        }
        @media(min-width:600px){ .nav-brand-name { display: block; } }
 
        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }
        .nav-links a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 30px;
            transition: color .2s, background .2s;
        }
        .nav-links a:hover { color: var(--white); background: rgba(255,255,255,0.08); }
        .nav-links .nav-login {
            background: var(--gold);
            color: var(--navy) !important;
            font-weight: 600;
            padding: 9px 22px;
        }
        .nav-links .nav-login:hover {
            background: var(--gold2);
        }
        .nav-toggle {
            display: none;
            background: none;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 8px;
            padding: 6px 10px;
            cursor: pointer;
            color: white;
            font-size: 18px;
        }
        @media(max-width:640px){
            .nav-toggle { display: block; }
            .nav-links { display: none; flex-direction: column; position: absolute; top: 70px; left: 0; right: 0; background: rgba(11,22,40,0.98); padding: 16px; gap: 4px; }
            .nav-links.open { display: flex; }
        }
 
        /* ── HERO ─────────────────────────────────── */
        .hero {
            min-height: 100vh;
            background: var(--navy);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 100px 5% 60px;
        }
 
        /* geometric background lines */
        .hero-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            border: 1px solid rgba(201,168,76,0.08);
            top: -200px; right: -200px;
        }
        .hero-bg::after {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            border: 1px solid rgba(201,168,76,0.06);
            bottom: -150px; left: -100px;
        }
        .hero-line {
            position: absolute;
            background: linear-gradient(180deg, transparent, rgba(201,168,76,0.12), transparent);
            width: 1px;
            height: 100%;
            top: 0;
        }
        .hero-line:nth-child(1) { left: 20%; }
        .hero-line:nth-child(2) { left: 40%; }
        .hero-line:nth-child(3) { left: 60%; }
        .hero-line:nth-child(4) { left: 80%; }
 
        .hero-content {
            text-align: center;
            position: relative;
            z-index: 2;
            max-width: 720px;
            animation: fadeUp .9s ease both;
        }
 
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 7px 18px;
            font-size: 12px;
            color: var(--gold);
            letter-spacing: .1em;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 28px;
            animation: fadeUp .9s .1s ease both;
        }
        .hero-badge::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--gold);
            border-radius: 50%;
            display: block;
        }
 
        .hero-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 20px;
            margin: 0 auto 28px;
            display: block;
            animation: fadeUp .9s .15s ease both;
            box-shadow: 0 8px 40px rgba(201,168,76,0.2);
        }
 
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 6vw, 4rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 18px;
            animation: fadeUp .9s .2s ease both;
        }
        .hero h1 span { color: var(--gold); }
 
        .hero-slogan {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            color: rgba(255,255,255,0.55);
            margin-bottom: 44px;
            font-weight: 300;
            line-height: 1.7;
            font-style: italic;
            animation: fadeUp .9s .3s ease both;
        }
 
        .hero-ctas {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeUp .9s .4s ease both;
        }
 
        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: var(--navy);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            padding: 14px 30px;
            border-radius: 50px;
            transition: background .2s, transform .2s, box-shadow .2s;
            letter-spacing: .03em;
        }
        .btn-gold:hover {
            background: var(--gold2);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(201,168,76,0.35);
        }
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(255,255,255,0.25);
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 14px 30px;
            border-radius: 50px;
            transition: border-color .2s, color .2s, background .2s;
        }
        .btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(201,168,76,0.05);
        }
 
        .hero-scroll {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.3);
            font-size: 11px;
            letter-spacing: .12em;
            text-transform: uppercase;
            animation: fadeUp .9s .6s ease both;
        }
        .scroll-line {
            width: 1px;
            height: 40px;
            background: linear-gradient(180deg, rgba(201,168,76,0.5), transparent);
            animation: scrollPulse 1.8s ease-in-out infinite;
        }
 
        /* ── STATS STRIP ─────────────────────────── */
        .stats-strip {
            background: var(--navy2);
            border-top: 1px solid rgba(201,168,76,0.1);
            border-bottom: 1px solid rgba(201,168,76,0.1);
        }
        .stats-inner {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 5%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0;
        }
        .stat-item {
            text-align: center;
            padding: 16px 20px;
            position: relative;
        }
        .stat-item + .stat-item::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 1px;
            background: rgba(201,168,76,0.15);
        }
        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }
        .stat-label {
            font-size: 12px;
            color: rgba(255,255,255,0.45);
            margin-top: 6px;
            text-transform: uppercase;
            letter-spacing: .1em;
        }
 
        /* ── SECTION BASE ────────────────────────── */
        section {
            padding: 90px 5%;
        }
        .section-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 12px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 700;
            color: var(--navy);
            line-height: 1.25;
            margin-bottom: 16px;
        }
        .section-title.light { color: var(--white); }
        .section-sub {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 520px;
        }
 
        /* ── ABOUT SECTION ───────────────────────── */
        #about {
            background: var(--cream);
        }
        .about-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        @media(max-width:760px){
            .about-inner { grid-template-columns: 1fr; gap: 40px; }
        }
        .about-img-wrap {
            position: relative;
        }
        .about-img-frame {
            background: var(--navy2);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 4/3;
            position: relative;
            overflow: hidden;
        }
        .about-img-frame::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(201,168,76,0.12), transparent 60%);
        }
        .about-img-frame img {
            width: 120px;
            object-fit: contain;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 8px 24px rgba(201,168,76,0.3));
        }
        .about-accent {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 120px;
            height: 120px;
            border: 2px solid var(--border);
            border-radius: 16px;
        }
        .about-text { padding: 0; }
        .about-text .section-sub {
            max-width: 100%;
            margin-bottom: 28px;
            color: #4a5568;
        }
        .about-features {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .feature-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: var(--white);
            border: 1px solid var(--cream2);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .feature-pill-dot {
            width: 8px; height: 8px;
            background: var(--gold);
            border-radius: 50%;
            flex-shrink: 0;
        }
 
        /* ── CONTACT SECTION ─────────────────────── */
        #contact {
            background: var(--navy);
            position: relative;
            overflow: hidden;
        }
        #contact::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            border: 1px solid rgba(201,168,76,0.06);
            top: -200px; right: -200px;
            pointer-events: none;
        }
        .contact-inner {
            max-width: 680px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .contact-header {
            text-align: center;
            margin-bottom: 48px;
        }
        .contact-form {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(201,168,76,0.15);
            border-radius: 20px;
            padding: 40px;
        }
        @media(max-width:600px){ .contact-form { padding: 24px 20px; } }
 
        .alert-box {
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-danger { background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
        .alert-success { background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.3); color: #86efac; }
 
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media(max-width:540px){ .form-row { grid-template-columns: 1fr; } }
 
        .form-group {
            margin-bottom: 18px;
        }
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 13px 16px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: var(--white);
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color .2s, background .2s;
            resize: none;
        }
        .form-control:focus {
            border-color: var(--gold);
            background: rgba(201,168,76,0.05);
        }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-hint { font-size: 11px; color: rgba(255,255,255,0.25); margin-top: 6px; }
 
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: var(--gold);
            color: var(--navy);
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            letter-spacing: .04em;
            margin-top: 8px;
        }
        .submit-btn:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(201,168,76,0.3);
        }
 
        /* ── FOOTER ──────────────────────────────── */
        footer {
            background: var(--navy2);
            border-top: 1px solid rgba(201,168,76,0.1);
            padding: 28px 5%;
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.3);
        }
        footer span { color: var(--gold); }
 
        /* ── ANIMATIONS ──────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes scrollPulse {
            0%, 100% { opacity: .4; transform: scaleY(1); }
            50%       { opacity: 1;  transform: scaleY(1.15); }
        }
 
        /* scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .7s ease, transform .7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
 
<!-- ═══ NAVBAR ═══════════════════════════════════════════════════ -->
<nav class="navbar" id="mainNav">
    <a class="nav-brand" href="#">
        <img src="logo.png" alt="Logo">
        <span class="nav-brand-name"><?=$setting['school_name']?></span>
    </a>
    <button class="nav-toggle" onclick="document.getElementById('navLinks').classList.toggle('open')">☰</button>
    <ul class="nav-links" id="navLinks">
        <li><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="login.php" class="nav-login">Login →</a></li>
    </ul>
</nav>
 
<!-- ═══ HERO ══════════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-bg">
        <div class="hero-line"></div>
        <div class="hero-line"></div>
        <div class="hero-line"></div>
        <div class="hero-line"></div>
    </div>
 
    <div class="hero-content">
        <div class="hero-badge">Est. Since Excellence</div>
        <img src="logo.png" alt="School Logo" class="hero-logo">
        <h1>Welcome to<br><span><?=$setting['school_name']?></span></h1>
        <p class="hero-slogan"><?=$setting['slogan']?></p>
        <div class="hero-ctas">
            <a href="login.php" class="btn-gold">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Student Login
            </a>
            <a href="#about" class="btn-ghost">
                Learn More
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
 
    <div class="hero-scroll">
        <div class="scroll-line"></div>
        <span>Scroll</span>
    </div>
</section>
 
<!-- ═══ STATS STRIP ════════════════════════════════════════════════ -->
<div class="stats-strip">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-num">25+</div>
            <div class="stat-label">Years of Excellence</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">2,400+</div>
            <div class="stat-label">Students Enrolled</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">86</div>
            <div class="stat-label">Expert Faculty</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">98%</div>
            <div class="stat-label">Pass Rate</div>
        </div>
    </div>
</div>
 
<!-- ═══ ABOUT ═════════════════════════════════════════════════════ -->
<section id="about">
    <div class="about-inner">
        <div class="about-img-wrap reveal">
            <div class="about-img-frame">
                <img src="logo.png" alt="School Logo">
            </div>
            <div class="about-accent"></div>
        </div>
        <div class="about-text reveal">
            <div class="section-tag">About Our School</div>
            <h2 class="section-title"><?=$setting['school_name']?></h2>
            <p class="section-sub"><?=$setting['about']?></p>
            <div class="about-features">
                <div class="feature-pill"><div class="feature-pill-dot"></div>World-class academic curriculum</div>
                <div class="feature-pill"><div class="feature-pill-dot"></div>Holistic development programs</div>
                <div class="feature-pill"><div class="feature-pill-dot"></div>State-of-the-art facilities</div>
                <div class="feature-pill"><div class="feature-pill-dot"></div>Experienced & dedicated faculty</div>
            </div>
        </div>
    </div>
</section>
 
<!-- ═══ CONTACT ════════════════════════════════════════════════════ -->
<section id="contact">
    <div class="contact-inner">
        <div class="contact-header reveal">
            <div class="section-tag" style="color:var(--gold)">Get In Touch</div>
            <h2 class="section-title light">Contact Us</h2>
            <p style="color:rgba(255,255,255,0.45);font-size:15px;margin-top:8px;">Have a question? We'd love to hear from you.</p>
        </div>
 
        <div class="contact-form reveal">
            <?php if (isset($_GET['error'])): ?>
            <div class="alert-box alert-danger"><?=$_GET['error']?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
            <div class="alert-box alert-success"><?=$_GET['success']?></div>
            <?php endif; ?>
 
            <form method="post" action="req/contact.php">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="you@email.com" required>
                        <div class="form-hint">We'll never share your email.</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message →</button>
            </form>
        </div>
    </div>
</section>
 
<!-- ═══ FOOTER ════════════════════════════════════════════════════ -->
<footer>
    Copyright &copy; <span><?=$setting['current_year']?></span> <span><?=$setting['school_name']?></span>. All rights reserved.
</footer>
 
<script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 40);
    });
    // Immediately apply if page loaded scrolled
    if (window.scrollY > 40) document.getElementById('mainNav').classList.add('scrolled');
 
    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 120);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });
    reveals.forEach(el => observer.observe(el));
</script>
</body>
</html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>
 
