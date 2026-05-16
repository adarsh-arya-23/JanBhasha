<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JanBhasha — AI-Powered Multilingual Translation for Indian Government Notices</title>
    <meta name="description" content="Streamline notice creation and delivery. Empower every citizen to understand official communications.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        :root{
            --saffron:#FF9933;--green:#138808;--navy:#1a237e;--blue:#1565c0;--blue-light:#1976d2;
            --bg:#f5f7fa;--white:#ffffff;--text:#1a1a2e;--text2:#4a5568;--text3:#718096;
            --border:#e2e8f0;--card:#ffffff;--shadow:0 2px 12px rgba(0,0,0,0.08);
        }
        body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);overflow-x:hidden;}
        a{text-decoration:none;color:inherit;}

        /* Tricolor */
        .tribar{height:4px;background:linear-gradient(90deg,#FF9933 33.33%,#fff 33.33% 66.66%,#138808 66.66%);position:fixed;top:0;left:0;right:0;z-index:100;}

        /* Navbar */
        nav{position:fixed;top:4px;left:0;right:0;z-index:90;background:var(--navy);padding:0 32px;}
        .nav-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:60px;}
        .nav-logo{display:flex;align-items:center;gap:10px;}
        .logo-box{width:36px;height:36px;background:linear-gradient(135deg,var(--saffron),#e65100);border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:900;color:#fff;font-size:14px;}
        .logo-text{color:#fff;font-weight:700;font-size:16px;}
        .logo-sub{color:rgba(255,255,255,0.6);font-size:11px;display:block;}
        .nav-right{display:flex;align-items:center;gap:12px;}
        .lang-select{background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:#fff;padding:6px 12px;border-radius:6px;font-size:13px;cursor:pointer;}
        .nav-btn{padding:8px 20px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;border:none;}
        .btn-ghost{background:transparent;color:#fff;border:1px solid rgba(255,255,255,0.3);}
        .btn-orange{background:var(--saffron);color:#fff;}
        .btn-orange:hover{background:#e65100;}
        .user-pill{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border-radius:8px;padding:6px 12px;color:#fff;font-size:13px;}

        /* Hero */
        .hero{padding:120px 32px 60px;background:linear-gradient(135deg,#fff 60%,#fff8f0 100%);text-align:center;}
        .hero-inner{max-width:800px;margin:0 auto;}
        .hero h1{font-size:42px;font-weight:800;line-height:1.2;color:var(--text);margin-bottom:16px;}
        .hero h1 span{color:var(--saffron);}
        .hero p{color:var(--text2);font-size:16px;line-height:1.7;max-width:560px;margin:0 auto 28px;}
        .hero-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}
        .btn-primary{background:var(--saffron);color:#fff;padding:12px 28px;border-radius:10px;font-weight:700;font-size:15px;border:none;cursor:pointer;transition:.2s;}
        .btn-primary:hover{background:#e65100;transform:translateY(-1px);}
        .btn-secondary{background:transparent;color:var(--navy);padding:12px 28px;border-radius:10px;font-weight:600;font-size:15px;border:2px solid var(--navy);cursor:pointer;transition:.2s;}
        .btn-secondary:hover{background:var(--navy);color:#fff;}

        /* Live preview card */
        .preview-card{max-width:700px;margin:40px auto 0;background:#fff;border-radius:16px;box-shadow:0 4px 30px rgba(0,0,0,0.1);padding:20px;text-align:left;}
        .preview-header{display:flex;align-items:center;gap:8px;margin-bottom:16px;font-size:13px;color:var(--text3);}
        .live-dot{width:8px;height:8px;border-radius:50%;background:#22c55e;animation:pulse 2s infinite;}
        @keyframes pulse{0%,100%{opacity:1;}50%{opacity:.4;}}
        .preview-flag{display:flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:var(--text2);margin-bottom:8px;}
        .preview-text{font-size:13px;color:var(--text2);line-height:1.6;background:#f8fafc;border-radius:8px;padding:12px;}
        .preview-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
        .preview-hi .preview-text{background:#fff8f0;font-family:'Noto Sans Devanagari',sans-serif;}
        .preview-badges{display:flex;gap:12px;margin-top:12px;padding-top:12px;border-top:1px solid var(--border);}
        .badge{font-size:11px;padding:4px 10px;border-radius:20px;font-weight:500;}
        .badge-green{background:#dcfce7;color:#166534;}
        .badge-blue{background:#dbeafe;color:#1e40af;}

        /* Stats */
        .stats{background:var(--navy);padding:40px 32px;}
        .stats-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:24px;text-align:center;}
        .stat-val{font-size:32px;font-weight:800;color:#fff;}
        .stat-label{font-size:13px;color:rgba(255,255,255,0.6);margin-top:4px;}

        /* Section base */
        .section{padding:60px 32px;}
        .section-inner{max-width:1200px;margin:0 auto;}
        .section-title{font-size:24px;font-weight:700;color:var(--text);margin-bottom:24px;}

        /* Notice cards */
        .notices-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
        .notice-card{background:#fff;border-radius:14px;padding:20px;box-shadow:var(--shadow);border:1px solid var(--border);}
        .notice-meta{display:flex;align-items:center;gap:8px;margin-bottom:12px;}
        .notice-org-icon{width:32px;height:32px;border-radius:8px;background:#f0f4ff;display:flex;align-items:center;justify-content:center;font-size:16px;}
        .notice-org{font-size:12px;font-weight:600;color:var(--text);}
        .notice-date{font-size:11px;color:var(--text3);}
        .notice-title{font-size:14px;font-weight:600;color:var(--text);margin-bottom:12px;line-height:1.4;}
        .notice-langs{display:flex;gap:8px;margin-bottom:12px;}
        .lang-tag{font-size:11px;color:var(--text2);background:#f8fafc;border:1px solid var(--border);padding:2px 8px;border-radius:4px;}
        .ai-badge{display:inline-flex;align-items:center;gap:4px;background:#fff3e0;color:#e65100;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;margin-bottom:12px;}
        .view-link{font-size:12px;color:var(--blue);font-weight:600;}
        .view-link:hover{text-decoration:underline;}

        /* Translation demo */
        .demo-section{background:#fff;border-radius:20px;box-shadow:var(--shadow);padding:32px;display:grid;grid-template-columns:1fr auto 1fr;gap:24px;align-items:start;}
        .demo-label{font-size:12px;font-weight:600;color:var(--text3);margin-bottom:8px;display:flex;align-items:center;gap:6px;}
        .demo-textarea{width:100%;border:1px solid var(--border);border-radius:10px;padding:14px;font-size:14px;color:var(--text);line-height:1.6;resize:none;font-family:inherit;min-height:120px;outline:none;}
        .demo-textarea:focus{border-color:var(--blue);}
        .demo-output{background:#f8fafc;border:1px solid var(--border);border-radius:10px;padding:14px;font-size:14px;color:var(--text);line-height:1.6;min-height:120px;font-family:'Noto Sans Devanagari',sans-serif;}
        .demo-mid{display:flex;flex-direction:column;gap:12px;align-items:center;justify-content:center;padding-top:24px;}
        .lang-sel{background:#fff;border:1px solid var(--border);border-radius:8px;padding:8px 12px;font-size:13px;color:var(--text);cursor:pointer;width:140px;}
        .translate-btn{background:var(--green);color:#fff;border:none;padding:12px 24px;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;width:140px;transition:.2s;}
        .translate-btn:hover{background:#0a6b04;}
        .demo-actions{display:flex;gap:10px;margin-top:12px;flex-wrap:wrap;}
        .action-btn{background:#f8fafc;border:1px solid var(--border);padding:8px 16px;border-radius:8px;font-size:13px;color:var(--text2);cursor:pointer;display:flex;align-items:center;gap:6px;}
        .action-btn:hover{border-color:var(--blue);color:var(--blue);}
        .publish-btn{background:var(--blue);color:#fff;border:none;padding:8px 20px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;}

        /* Languages */
        .langs-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px;}
        .dept-grid{display:flex;flex-wrap:wrap;gap:16px;}
        .dept-item{display:flex;flex-direction:column;align-items:center;gap:6px;width:70px;}
        .dept-icon{width:52px;height:52px;border-radius:12px;background:#f0f4ff;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:22px;}
        .dept-name{font-size:11px;color:var(--text2);text-align:center;font-weight:500;}
        .lang-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
        .lang-item{display:flex;flex-direction:column;align-items:center;gap:6px;background:#fff;border:1px solid var(--border);border-radius:10px;padding:12px 8px;}
        .lang-script{font-size:18px;}
        .lang-name{font-size:11px;color:var(--text2);font-weight:500;}

        /* Public services */
        .services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
        .service-item{background:#fff;border:1px solid var(--border);border-radius:12px;padding:20px;text-align:center;}
        .service-icon{font-size:28px;margin-bottom:10px;}
        .service-title{font-size:13px;font-weight:600;color:var(--text);}

        /* Accessibility */
        .a11y-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;}
        .a11y-item{display:flex;align-items:flex-start;gap:12px;background:#fff;border:1px solid var(--border);border-radius:10px;padding:16px;}
        .a11y-icon{font-size:22px;flex-shrink:0;}
        .a11y-title{font-size:13px;font-weight:600;color:var(--text);}
        .a11y-desc{font-size:12px;color:var(--text3);margin-top:2px;}

        /* Two-col layout */
        .two-col{display:grid;grid-template-columns:1fr 1fr;gap:40px;}
        .sub-title{font-size:18px;font-weight:700;color:var(--text);margin-bottom:16px;}

        /* Footer */
        footer{background:var(--navy);padding:20px 32px;text-align:center;}
        .footer-links{display:flex;justify-content:center;gap:24px;flex-wrap:wrap;margin-bottom:12px;}
        .footer-links a{color:rgba(255,255,255,0.6);font-size:13px;}
        .footer-links a:hover{color:#fff;}
        .footer-copy{color:rgba(255,255,255,0.4);font-size:12px;}
        .footer-top{display:flex;justify-content:center;gap:32px;margin-bottom:12px;flex-wrap:wrap;}
        .footer-top a{color:rgba(255,255,255,0.7);font-size:12px;}

        @media(max-width:900px){
            .notices-grid,.stats-inner,.langs-grid,.two-col{grid-template-columns:1fr;}
            .demo-section{grid-template-columns:1fr;}
            .hero h1{font-size:28px;}
            .preview-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>
    <div class="tribar"></div>

    <!-- Navbar -->
    <nav>
        <div class="nav-inner">
            <a href="{{ auth()->check() ? route('dashboard') : '/' }}" class="nav-logo">
                <div class="logo-box">JB</div>
                <div>
                    <span class="logo-text">JanBhasha</span>
                    <span class="logo-sub">सॉफ्टवेयर सेवा</span>
                </div>
            </a>
            <div class="nav-right">
                <select class="lang-select">
                    <option>🌐 English</option>
                    <option>हिंदी</option>
                </select>
                <span style="color:rgba(255,255,255,0.5);font-size:13px;">A+</span>
                <div class="user-pill">
                    <span>👤</span>
                    <span>Rajesh Kumar</span>
                    <span style="font-size:11px;color:rgba(255,255,255,0.5);">Ministry of Electronics &amp; IT</span>
                </div>
                <a href="{{ route('register') }}" class="nav-btn btn-orange">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-inner">
            <h1>AI-Powered Multilingual Translation<br>for <span>Indian Government Notices</span></h1>
            <p>Streamline notice creation and delivery. Empower every citizen to understand official communications.</p>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="btn-primary">Translate New Notice</a>
                <a href="{{ route('login') }}" class="btn-secondary">Learn More</a>
            </div>

            <!-- Live Preview -->
            <div class="preview-card">
                <div class="preview-header">
                    <span class="live-dot"></span>
                    Live Translation Preview
                </div>
                <div class="preview-grid">
                    <div class="preview-en">
                        <div class="preview-flag">🇬🇧 English (Original)</div>
                        <div class="preview-text">The Ministry of Finance announces new measures for rural development, under the PM Awas Yojana scheme. Promotion loan announces new accessment pension for farmers under the general economics…</div>
                    </div>
                    <div class="preview-hi">
                        <div class="preview-flag">🇮🇳 Hindi (AI Translation)</div>
                        <div class="preview-text">वित्त मंत्रालय ग्रामीण विकास के लिए नई योजनाएं घोषित करता है, PM आवास योजना के तहत। प्रमोशन ऋण किसानों के लिए सामान्य अर्थव्यवस्था के तहत नए मूल्यांकन पेंशन की घोषणा करता है…</div>
                    </div>
                </div>
                <div class="preview-badges">
                    <span class="badge badge-green">✅ Glossary Protected</span>
                    <span class="badge badge-blue">⚡ 0.3s response</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <div class="stats">
        <div class="stats-inner">
            <div>
                <div class="stat-val">50+</div>
                <div class="stat-label">Government Depts.</div>
            </div>
            <div>
                <div class="stat-val">2M+</div>
                <div class="stat-label">Notices Translated</div>
            </div>
            <div>
                <div class="stat-val">99.9%</div>
                <div class="stat-label">Uptime SLA</div>
            </div>
            <div>
                <div class="stat-val">&lt; 1s</div>
                <div class="stat-label">Avg. Response</div>
            </div>
        </div>
    </div>

    <!-- Latest Notices -->
    <section class="section" style="background:#f5f7fa;">
        <div class="section-inner">
            <div class="section-title">Latest Government Notices</div>
            <div class="notices-grid">
                @foreach([
                    ['🏠','MoHit','Pradhan Mantri Awas Yojana — Allocation Notice','18.11.2024'],
                    ['💰','MoF','Ministry of Finance — GST Collection Update','13.11.2024'],
                    ['🚔','Delhi Police','Delhi Police — Public Advisory','13.11.2024'],
                ] as $n)
                <div class="notice-card">
                    <div class="notice-meta">
                        <div class="notice-org-icon">{{ $n[0] }}</div>
                        <div>
                            <div class="notice-org">{{ $n[1] }}</div>
                            <div class="notice-date">📅 {{ $n[3] }}</div>
                        </div>
                    </div>
                    <div class="notice-title">{{ $n[2] }}</div>
                    <div class="notice-langs">
                        <span class="lang-tag">English</span>
                        <span class="lang-tag">Hindi</span>
                        <span class="lang-tag" style="color:var(--text3);">Download languages</span>
                    </div>
                    <div class="ai-badge">✨ AI-Ready</div>
                    <br>
                    <a href="{{ route('login') }}" class="view-link">View Details →</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Translation Demo -->
    <section class="section" style="background:#fff;">
        <div class="section-inner">
            <div class="section-title">Try Translation</div>
            <div class="demo-section">
                <div>
                    <div class="demo-label">🇬🇧 English (Original)</div>
                    <textarea class="demo-textarea" id="src-text" rows="5" placeholder="Type or paste government notice here...">The Ministry of Finance announces new measures for rural development, under the PM Awas Yojana scheme. Promotion loan announces new accessment pension for farmers under the general economics of finance to propose new measures for rural development under the PMAY scheme.</textarea>
                    <div style="margin-top:10px;display:flex;gap:8px;">
                        <button class="action-btn">📎 Browse / Upload</button>
                    </div>
                </div>
                <div class="demo-mid">
                    <div style="font-size:12px;color:var(--text3);">Translating into:</div>
                    <select class="lang-sel" id="target-lang">
                        <option value="hi">देवनागरी</option>
                        <option value="ta">தமிழ்</option>
                        <option value="te">తెలుగు</option>
                        <option value="bn">বাংলা</option>
                        <option value="mr">मराठी</option>
                        <option value="gu">ગુજરાતી</option>
                    </select>
                    <button class="translate-btn" onclick="doTranslate()">Translate</button>
                    <div style="font-size:11px;color:var(--text3);text-align:center;">0.0</div>
                </div>
                <div>
                    <div class="demo-label">🇮🇳 Hindi (AI Translation) <span class="badge badge-green" style="margin-left:auto;">✅ Glossary Protected</span> <span class="badge badge-blue">✔ Verification</span></div>
                    <div class="demo-output" id="translated-out">वित्त मंत्रालय ग्रामीण विकास के लिए नई योजनाएं घोषित करता है। पीएम आवास योजना के तहत प्रोमोशन ऋण किसानों के लिए नई एक्सेसमेंट पेंशन की घोषणा करता है सामान्य अर्थव्यवस्था के तहत वित्त को ग्रामीण विकास के नए उपाय प्रस्तावित करने के लिए पीएमएवाई योजना के तहत।</div>
                    <div class="demo-actions">
                        <button class="action-btn">💾 Save Draft</button>
                        <button class="publish-btn">📢 Publish Notice</button>
                    </div>
                    <div style="margin-top:10px;display:flex;flex-direction:column;gap:6px;">
                        <button class="action-btn">📄 PDF Download →</button>
                        <button class="action-btn">🔤 Devanagari Download →</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Languages & Departments -->
    <section class="section" style="background:#f5f7fa;">
        <div class="section-inner">
            <div class="langs-grid">
                <div>
                    <div class="sub-title">Supported Languages &amp; Departments</div>
                    <div class="dept-grid">
                        @foreach([['🏛️','MoKit'],['🏛️','MoHUA'],['💰','MoF'],['🏛️','MoF'],['🏛️','MoF'],['🏥','MoHFW'],['🚔','Delhi Police']] as $d)
                        <div class="dept-item">
                            <div class="dept-icon">{{ $d[0] }}</div>
                            <div class="dept-name">{{ $d[1] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="sub-title">Supported Languages</div>
                    <div class="lang-grid">
                        @foreach([['🇬🇧','English'],['हि','Hindi'],['বা','Bengali'],['అ','Telugu'],['ত','Telugu'],['मा','Marathi'],['த','Tamil'],['த','Tamil'],['मर','Marathi'],['த','Tamil'],['Depts','Depts'],['Belic','Belic']] as $l)
                        <div class="lang-item">
                            <div class="lang-script">{{ $l[0] }}</div>
                            <div class="lang-name">{{ $l[1] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Public Services + Accessibility -->
    <section class="section" style="background:#fff;">
        <div class="section-inner two-col">
            <div>
                <div class="sub-title">Public Services</div>
                <div class="services-grid">
                    @foreach([['✅','Verify Translated Notice'],['💬','Citizens Feedback'],['📡','API Documentation']] as $s)
                    <div class="service-item">
                        <div class="service-icon">{{ $s[0] }}</div>
                        <div class="service-title">{{ $s[1] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="sub-title">Accessibility Focus</div>
                <div class="a11y-grid">
                    @foreach([
                        ['Aa','Large fonts','Large fonts aids and services'],
                        ['◑','High contrast','High contrast and rural services'],
                        ['◑','High contrast','High contrast ability and users'],
                        ['🔊','Voice-to-text','Integration elderly and rural users'],
                    ] as $a)
                    <div class="a11y-item">
                        <div class="a11y-icon">{{ $a[0] }}</div>
                        <div>
                            <div class="a11y-title">{{ $a[1] }}</div>
                            <div class="a11y-desc">{{ $a[2] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-top">
            <a href="#">About JanBhasha</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Feedback</a>
            <a href="#">Help Centre</a>
            <a href="#">Digital India Portal</a>
        </div>
        <div class="footer-copy">© {{ date('Y') }} JanBhasha — An Initiative by Ministry of Electronics &amp; IT, Government of India. Hosted by NIC.</div>
    </footer>

    <script>
    function doTranslate() {
        const text = document.getElementById('src-text').value;
        const lang = document.getElementById('target-lang').value;
        const out = document.getElementById('translated-out');
        out.textContent = 'Translating…';
        fetch('/api/translate', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
            body:JSON.stringify({text,target_language:lang,source_language:'en'})
        })
        .then(r=>r.json())
        .then(d=>{ out.textContent = d.translated_text || d.error || 'Error'; })
        .catch(()=>{ out.textContent = 'Translation failed.'; });
    }
    </script>
</body>
</html>
