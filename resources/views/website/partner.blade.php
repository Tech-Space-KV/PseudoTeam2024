<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PseudoTeam • Freelance Reinvented</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <style>
    :root {
      --primary: #007BFF;
      --dark: #0056b3;
      --light-bg: #f5f7fa;
      --text: #0a0a0a;
      --font-main: 'Inter', sans-serif;
    }
    html { scroll-behavior: smooth; }
    body {
      font-family: var(--font-main);
      padding-top: 72px;
      background-color: #fff;
      color: var(--text);
    }
    section { position: relative; padding: 6rem 0; }
    section + section { padding-top: 3rem; }
    .divider-bottom {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 80px;
      background: var(--light-bg);
      z-index: -1;
    }
    h1,h2,h3,h5 { font-weight: 700; line-height: 1.2; }
    .btn-signup {
      background-color: var(--primary);
      color: white;
      font-weight: 600;
      border-radius: 50px;
      padding: .75rem 2rem;
      box-shadow: 0 6px 16px rgba(0,123,255,0.25);
      transition: .3s;
    }
    .btn-signup:hover { background-color: var(--dark); transform: translateY(-2px); }
    .hero {
      background: linear-gradient(135deg,var(--primary),var(--dark));
      color: white;
      text-align: center;
    }
    .hero h1 { font-size: 3.4rem; }
    .features .card {
      border: none;
      border-radius: 16px;
      padding: 2rem;
      background: white;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      transition: .3s;
    }
    .features .card:hover { transform: translateY(-8px); }
    .features .card i {
      font-size: 2.5rem;
      color: var(--primary);
      transition: .3s;
    }
    .features .card:hover i { transform: scale(1.2); }
    .stats .stat-number {
      font-size: 2.5rem;
      color: var(--primary);
    }
    .steps .step-icon {
      font-size: 2rem;
      background: var(--primary);
      color: white;
      width: 60px;
      height: 60px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin-bottom: 1rem;
    }
    .team .member-photo {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: .5rem;
    }
    .faq .card {
      border: none;
      border-bottom: 1px solid #ddd;
      border-radius: 0;
    }
    .footer {
      background: var(--light-bg);
      padding: 3rem 0;
    }
    .footer a { color: #333; text-decoration: none; }
    .footer a:hover { color: var(--primary); }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#"><span class="text-primary">Pseudo</span>Team</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navCollapse">
        <a href="{{ route('auth.sp.sign_in') }}" class="btn btn-outline-primary btn-sm rounded-pill me-2">Log In</a>
        <a href="{{ route('auth.sp.sign_up') }}" class="btn btn-primary btn-sm rounded-pill">Sign Up</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero" data-aos="fade-up">
    <div class="container">
      <h1>Work Smart, Not Hard</h1>
      <h1>Join PseudoTeam</h1>
      <p class="lead mt-3">Skip proposals. Focus on delivery. Get paid reliably.</p>
      <a href="#" class="btn btn-signup btn-lg mt-3">Become a Partner</a>
      <form class="search-bar mx-auto mt-4" style="max-width:600px;">
        <div class="input-group shadow-sm">
          <input type="text" class="form-control" placeholder="Search for projects">
          <button class="btn btn-light px-4" type="submit"><i class="bi bi-search"></i></button>
        </div>
      </form>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- FEATURES -->
  <section class="features bg-light" data-aos="fade-up">
    <div class="container">
      <div class="row g-4 text-center">
        <div class="col-md-4">
          <div class="card">
            <i class="bi bi-kanban"></i>
            <h5>Managed Projects</h5>
            <p>Projects are managed, so you focus on work that fits your skillset.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <i class="bi bi-puzzle"></i>
            <h5>Scoped Tasks</h5>
            <p>Deliver exactly what's required—no confusion or scope creep.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <i class="bi bi-wallet2"></i>
            <h5>Milestone Payouts</h5>
            <p>Get paid on time for completed work—guaranteed.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- STATS -->
  <section class="stats text-center" data-aos="fade-up">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3">
          <div class="stat-number" data-count="500">0</div>
          <p>Service Partners</p>
        </div>
        <div class="col-md-3">
          <div class="stat-number" data-count="1200">0</div>
          <p>Projects Delivered</p>
        </div>
        <div class="col-md-3">
          <div class="stat-number" data-count="4.9">0</div>
          <p>Average Rating</p>
        </div>
        <div class="col-md-3">
          <div class="stat-number" data-count="100">0</div>
          <p>Payment Success Rate (%)</p>
        </div>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="steps bg-light" data-aos="fade-up">
    <div class="container text-center">
      <h2>How It Works</h2>
      <div class="row mt-4">
        <div class="col-md-3">
          <div class="step-icon"><i class="bi bi-pencil-square"></i></div>
          <h5>Apply to Join</h5>
          <p>Submit your skills and portfolio for vetting.</p>
        </div>
        <div class="col-md-3">
          <div class="step-icon"><i class="bi bi-gear"></i></div>
          <h5>Receive Tasks</h5>
          <p>Assigned bite-sized deliverables per project milestone.</p>
        </div>
        <div class="col-md-3">
          <div class="step-icon"><i class="bi bi-check2-circle"></i></div>
          <h5>Submit Work</h5>
          <p>Deliver quality work reviewed by project managers.</p>
        </div>
        <div class="col-md-3">
          <div class="step-icon"><i class="bi bi-currency-dollar"></i></div>
          <h5>Get Paid</h5>
          <p>Receive milestone payouts securely and on time.</p>
        </div>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- TEAM -->
  <section class="team text-center" data-aos="fade-up">
    <div class="container">
      <h2>Meet the Team</h2>
      <div class="row mt-4 justify-content-center">
        <div class="col-md-2 col-6 mb-4">
          <img src="https://via.placeholder.com/100" alt="Alex" class="member-photo mx-auto shadow">
          <h6>Alex</h6>
          <p>Founder & CEO</p>
        </div>
        <div class="col-md-2 col-6 mb-4">
          <img src="https://via.placeholder.com/100" alt="Priya" class="member-photo mx-auto shadow">
          <h6>Priya</h6>
          <p>Head of Operations</p>
        </div>
        <div class="col-md-2 col-6 mb-4">
          <img src="https://via.placeholder.com/100" alt="Ravi" class="member-photo mx-auto shadow">
          <h6>Ravi</h6>
          <p>Project Lead</p>
        </div>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials bg-light" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-4">What Our Partners Say</h2>
      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner text-center">
          <div class="carousel-item active">
            <blockquote class="blockquote">
              <p>"I delivered more work this month than ever—without chasing clients."</p>
              <footer class="blockquote-footer">— Aanya, Service Partner</footer>
            </blockquote>
          </div>
          <div class="carousel-item">
            <blockquote class="blockquote">
              <p>"Milestone payouts reliably hit my bank account—every time."</p>
              <footer class="blockquote-footer">— Vijay, UI/UX Designer</footer>
            </blockquote>
          </div>
          <div class="carousel-item">
            <blockquote class="blockquote">
              <p>"Clear project briefs let me focus entirely on quality delivery."</p>
              <footer class="blockquote-footer">— Sara, Front‑End Developer</footer>
            </blockquote>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- BLOG & RESOURCES -->
  <section class="blog" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-4">Insights & Resources</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Blog 1">
            <div class="card-body">
              <h5 class="card-title">5 Tips for Freelance Consistency</h5>
              <p class="card-text">Best practices to stay steady and grow month over month.</p>
              <a href="#" class="stretched-link text-primary">Read more</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Blog 2">
            <div class="card-body">
              <h5 class="card-title">How Project Managers Boost Your Output</h5>
              <p class="card-text">Why dedicated PMs matter in large-scale freelance delivery.</p>
              <a href="#" class="stretched-link text-primary">Read more</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Blog 3">
            <div class="card-body">
              <h5 class="card-title">Milestone Payments Done Right</h5>
              <p class="card-text">A transparent view into how we guarantee your payouts.</p>
              <a href="#" class="stretched-link text-primary">Read more</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- FAQ -->
  <section class="faq bg-light" data-aos="fade-up">
    <div class="container">
      <h2 class="text-center mb-4">Frequently Asked Questions</h2>
      <div class="accordion" id="faqAccordion">
        <div class="accordion-item faq">
          <h3 class="accordion-header" id="faq1">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">What kind of work is available?</button>
          </h3>
          <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">We offer tasks across design, development, writing, marketing, and more—each scoped per milestone.</div>
          </div>
        </div>
        <div class="accordion-item faq">
          <h3 class="accordion-header" id="faq2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">How are milestone payments handled?</button>
          </h3>
          <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Once a milestone is approved by your manager, we release funds immediately—guaranteed.</div>
          </div>
        </div>
        <div class="accordion-item faq">
          <h3 class="accordion-header" id="faq3">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">Can I choose my projects?</button>
          </h3>
          <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Managers typically assign based on your expertise—though you're free to express preferences.</div>
          </div>
        </div>
      </div>
    </div>
    <div class="divider-bottom"></div>
  </section>

  <!-- FINAL CTA -->
  <section class="cta-banner text-center" style="padding:6rem 1rem; background:var(--primary); color:#fff;" data-aos="fade-up">
    <div class="container">
      <h2>Ready to grow your freelance career with support and clarity?</h2>
      <a href="#" class="btn btn-light btn-lg mt-3">Join Today</a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5>PseudoTeam</h5>
          <p>&copy; 2025 All rights reserved.</p>
        </div>
        <div class="col-md-2">
          <h6>Company</h6>
          <ul class="list-unstyled">
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Connect</h6>
          <ul class="list-unstyled">
            <li><a href="#"><i class="bi bi-linkedin me-1"></i>LinkedIn</a></li>
            <li><a href="#"><i class="bi bi-twitter me-1"></i>Twitter</a></li>
            <li><a href="#"><i class="bi bi-instagram me-1"></i>Instagram</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Legal</h6>
          <ul class="list-unstyled">
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Cookies</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.stat-number').forEach(el => {
        const target = parseFloat(el.getAttribute('data-count'));
        let current = 0;
        const step = target / 100;
        const format = el.getAttribute('data-count').includes('.') ? v => v.toFixed(1) : v => Math.ceil(v);
        (function update() {
          current += step;
          el.innerText = current < target ? format(current) : format(target);
          if (current < target) setTimeout(update, 20);
        })();
      });
    });
  </script>
</body>
</html>