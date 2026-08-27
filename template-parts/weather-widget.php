<?php
// template-parts/weather-widget.php
?>
<div class="kish-weather-widget" dir="rtl" style="max-width:1200px;margin:0 auto;">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <div class="weather-container" style="background:rgba(255,255,255,0.22);backdrop-filter:blur(8px);border-radius:30px;padding:22px;box-shadow:0 8px 32px rgba(31,38,135,0.08);">
        <div style="display:flex;gap:20px;align-items:center;flex-wrap:wrap;">
            <div style="flex:1;min-width:200px;text-align:right;">
                <h3 style="font-family:'Vazirmatn',sans-serif;font-size:2.4rem;margin:0;color:#0a2647;">آب و هوای <span style="color:#ff8c00">لحظه‌ای</span> کیش</h3>
                <p style="margin:6px 0;color:#1a3b5c;">وضعیت امروز جزیره - ≈</p>
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="font-size:4.5rem;font-weight:700;color:#0a2647;">32&deg;</div>
                    <div>
                        <div style="font-size:1.2rem;font-weight:600;color:#0a2647;">صاف</div>
                        <div style="font-size:1rem;color:#1c3f6e;">کیش</div>
                    </div>
                </div>
            </div>
            <div style="min-width:220px;flex:0 0 220px;text-align:center;">
                <img src="https://via.placeholder.com/200x200.png?text=Hippo" alt="character" style="width:200px;height:200px;object-fit:contain;" />
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:18px;justify-content:space-between;flex-wrap:wrap;">
            <div style="flex:1;min-width:90px;padding:15px;border-radius:20px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);text-align:center;">
                <div style="font-size:0.8rem;color:#1a3b5c;">رطوبت</div>
                <div style="font-size:1.1rem;font-weight:700;color:#0a2647;">68%</div>
                <div style="font-size:0.7rem;color:#374151;">حداقل</div>
            </div>
            <div style="flex:1;min-width:90px;padding:15px;border-radius:20px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);text-align:center;">
                <div style="font-size:0.8rem;color:#1a3b5c;">باد</div>
                <div style="font-size:1.1rem;font-weight:700;color:#0a2647;">12 km/h</div>
                <div style="font-size:0.7rem;color:#374151;">وزش جنوب</div>
            </div>
            <div style="flex:1;min-width:90px;padding:15px;border-radius:20px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);text-align:center;">
                <div style="font-size:0.8rem;color:#1a3b5c;">دما احساس</div>
                <div style="font-size:1.1rem;font-weight:700;color:#0a2647;">34&deg;</div>
                <div style="font-size:0.7rem;color:#374151;">گرم</div>
            </div>
            <div style="flex:1;min-width:90px;padding:15px;border-radius:20px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);text-align:center;">
                <div style="font-size:0.8rem;color:#1a3b5c;">دریا</div>
                <div style="font-size:1.1rem;font-weight:700;color:#0a2647;">آرام</div>
                <div style="font-size:0.7rem;color:#374151;">مناسب شنا</div>
            </div>
            <div style="flex:1;min-width:90px;padding:15px;border-radius:20px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);text-align:center;">
                <div style="font-size:0.8rem;color:#1a3b5c;">طلوع</div>
                <div style="font-size:1.1rem;font-weight:700;color:#0a2647;">05:12</div>
                <div style="font-size:0.7rem;color:#374151;">غروب 18:24</div>
            </div>
        </div>
    </div>
</div>
