@extends('layouts.app')

@section('title', 'কাস্টমার কেয়ার - RosTop 24/7 Support & Help Center')
@section('meta_description', 'রোস্টপ কাস্টমার কেয়ার - ২৪/৭ সার্বক্ষণিক সহায়তা, অর্ডার ট্র্যাকিং, রিফান্ড, পেমেন্ট ও লাইভ চ্যাট সাপোর্ট।')

@section('content')
<div class="support-page-container">
    <div class="container py-3 py-md-4" style="max-width: 680px;">

        <!-- Top Bar with Back Navigation -->
        <div class="support-topbar mb-3">
            <a href="{{ route('home') }}" class="support-back-link" aria-label="Go Back to Home">
                <i data-lucide="chevron-left" class="icon"></i>
            </a>
            <h1 class="support-page-title">কাস্টমার কেয়ার</h1>
            <div style="width: 38px;"></div> <!-- visual balance -->
        </div>

        <!-- Hero Support Card (Orange Gradient matching reference) -->
        <div class="support-hero-card">
            <div class="support-hero-header">
                <div class="support-avatar-circle">
                    <i data-lucide="headphones" class="icon"></i>
                    <span class="support-status-dot" title="অনলাইনে উপস্থিত"></span>
                </div>
                <div>
                    <h2 class="support-hero-title">রোস্টপ কাস্টমার সাপোর্ট</h2>
                    <div class="support-response-badge">
                        <span class="pulse-dot"></span> সাধারণত ~২-৫ মিনিটে উত্তর দেওয়া হয়
                    </div>
                </div>
            </div>

            <p class="support-hero-subtitle">
                আমরা ২৪/৭ উপস্থিত &ndash; গড় রেসপন্স ২ মিনিটের নিচে। যে কোনো অর্ডার, পেমেন্ট অথবা রিফান্ড সংক্রান্ত প্রয়োজনে বার্তা দিন।
            </p>

            <button type="button" class="support-live-chat-btn" id="trigger-live-chat-btn">
                <i data-lucide="message-square" class="icon"></i>
                <span>লাইভ চ্যাট শুরু করুন</span>
            </button>
        </div>

        <!-- Help Topics Section -->
        <div class="support-section-block">
            <div class="support-section-heading">
                <i data-lucide="help-circle" class="icon"></i>
                <span>আমরা আপনাকে কীভাবে সাহায্য করতে পারি?</span>
            </div>

            <div class="support-topics-list">
                <!-- 1. Order Issue -->
                <a href="{{ route('track.order') }}" class="support-topic-item">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(56, 189, 248, 0.12); color: #0284C7;">
                            <i data-lucide="shopping-bag" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">অর্ডার ইস্যু</div>
                            <div class="support-topic-desc">অর্ডারের সমস্যা ট্র্যাক বা রিপোর্ট করুন</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </a>

                <!-- 2. Payment Issue -->
                <button type="button" class="support-topic-item topic-chat-trigger" data-issue="Payment Issue">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(16, 185, 129, 0.12); color: #059669;">
                            <i data-lucide="credit-card" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">পেমেন্ট</div>
                            <div class="support-topic-desc">পেমেন্ট ব্যর্থতা, রিফান্ড বা অতিরিক্ত চার্জ</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </button>

                <!-- 3. KYC / Account -->
                <button type="button" class="support-topic-item topic-chat-trigger" data-issue="KYC & Account Access">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(147, 51, 234, 0.12); color: #9333EA;">
                            <i data-lucide="shield-check" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">কেওয়াইসি / অ্যাকাউন্ট</div>
                            <div class="support-topic-desc">পরিচয় যাচাই বা অ্যাকাউন্ট এক্সেস সমস্যা</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </button>

                <!-- 4. Appeal / Fraud Report -->
                <button type="button" class="support-topic-item topic-chat-trigger" data-issue="Decision Appeal / Report">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(31, 163, 126, 0.12); color: #128A68;">
                            <i data-lucide="scale" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">আপিল</div>
                            <div class="support-topic-desc">সিদ্ধান্তের আপিল বা প্রতারণা রিপোর্ট করুন</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </button>

                <!-- 5. Direct Support Contact -->
                <button type="button" class="support-topic-item topic-chat-trigger" data-issue="Direct Support">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(6, 182, 212, 0.12); color: #0891B2;">
                            <i data-lucide="headset" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">সরাসরি কাস্টমার সাপোর্টে যোগাযোগ করুন</div>
                            <div class="support-topic-desc">সরাসরি সাপোর্ট প্রতিনিধির সাথে চ্যাট করুন</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </button>
            </div>
        </div>

        <!-- Official Email Support Card -->
        <a href="mailto:support@rostop.com?subject=RosTop%20Customer%20Inquiry" class="support-email-card mb-4">
            <div class="support-topic-left">
                <div class="support-topic-icon" style="background: rgba(59, 130, 246, 0.12); color: #2563EB;">
                    <i data-lucide="mail" class="icon"></i>
                </div>
                <div>
                    <div class="support-topic-title">অফিসিয়াল অনুসন্ধান পাঠান</div>
                    <div class="support-topic-desc">support@rostop.com &bull; বিস্তারিত তথ্য, রিপোর্ট ও আপিল পাঠান</div>
                </div>
            </div>
            <i data-lucide="chevron-right" class="icon chevron"></i>
        </a>

        <!-- FAQ Accordion Section -->
        <div class="support-section-block">
            <div class="support-section-heading">
                <i data-lucide="help-circle" class="icon"></i>
                <span>সাধারণ প্রশ্নাবলী (FAQs)</span>
            </div>

            <div class="support-faq-list">
                <div class="support-faq-item">
                    <button type="button" class="support-faq-btn">
                        <span>আমি আমার অর্ডার কীভাবে ট্র্যাক করব?</span>
                        <i data-lucide="chevron-down" class="icon chevron"></i>
                    </button>
                    <div class="support-faq-body">
                        অর্ডার সম্পন্ন হওয়ার পর আপনি একটি নির্দিষ্ট ৮-সংখ্যার ট্র্যাকিং কোড (যেমন: RT-98234) পাবেন। আমাদের <a href="{{ route('track.order') }}">Live Order Tracker</a> পেজে এই কোডটি দিলেই আপনার অর্ডারের তাৎক্ষণিক ভেরিফিকেশন ও ডেলিভারি স্ট্যাটাস দেখতে পাবেন।
                    </div>
                </div>

                <div class="support-faq-item">
                    <button type="button" class="support-faq-btn">
                        <span>আমি কবে আমার রিফান্ড পাব?</span>
                        <i data-lucide="chevron-down" class="icon chevron"></i>
                    </button>
                    <div class="support-faq-body">
                        যদি কোনো টেকনিক্যাল কারণে সার্ভার টপ-আপ প্রদান করতে ব্যর্থ হয়, তবে তাৎক্ষণিক আমাদের সাপোর্ট টিমের মাধ্যমে স্বয়ংক্রিয়ভাবে আপনার bKash বা Nagad একাউন্টে ৩০ মিনিটের মধ্যে পুরো টাকা রিফান্ড সম্পন্ন করা হয়।
                    </div>
                </div>

                <div class="support-faq-item">
                    <button type="button" class="support-faq-btn">
                        <span>আমি কীভাবে অ্যাকাউন্ট ভেরিফাই করব?</span>
                        <i data-lucide="chevron-down" class="icon chevron"></i>
                    </button>
                    <div class="support-faq-body">
                        ছোট পরিমাণ অর্ডারের জন্য কোনো বিশেষ আইডি ভেরিফিকেশন প্রয়োজন নেই। বড় অঙ্কের গিফট কার্ড সেল বা হাই-ভলিউম ট্রানজেকশনের ক্ষেত্রে আমাদের সিকিউরিটি টিম ওয়াটসঅ্যাপে নিরাপদ KYC ডকুমেন্ট ভেরিফিকেশন সম্পন্ন করে।
                    </div>
                </div>

                <div class="support-faq-item">
                    <button type="button" class="support-faq-btn">
                        <span>গিফট কার্ড বিক্রির টাকা কতক্ষণে পাওয়া যায়?</span>
                        <i data-lucide="chevron-down" class="icon chevron"></i>
                    </button>
                    <div class="support-faq-body">
                        ভাউচার কোড সাবমিট করার পর আমাদের ভেরিফিকেশন টিম ১৫ থেকে ৪৫ মিনিটের মধ্যে ব্যালেন্স চেক করে সরাসরি আপনার বিকাশ, নগদ বা USDT ওয়ালেটে পেমেন্ট পাঠিয়ে দেয়।
                    </div>
                </div>
            </div>
        </div>

        <!-- Official Policies & Customer Protection Block -->
        <div class="support-section-block mt-4">
            <div class="support-section-heading">
                <i data-lucide="shield-check" class="icon"></i>
                <span>নীতিমালা ও গ্রাহক সুরক্ষা (Legal &amp; Policies)</span>
            </div>
            <div class="support-topics-list">
                <a href="{{ route('terms') }}" class="support-topic-item">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(31, 163, 126, 0.12); color: var(--primary);">
                            <i data-lucide="file-text" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">ব্যবহারের শর্তাবলী (Terms of Service)</div>
                            <div class="support-topic-desc">প্ল্যাটফর্ম নিয়মাবলী, কাউন্টারপার্টি মডেল ও আইনগত শর্ত</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </a>
                <a href="{{ route('privacy') }}" class="support-topic-item">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(6, 182, 212, 0.12); color: #0891B2;">
                            <i data-lucide="lock" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">গোপনীয়তা নীতি (Privacy Policy)</div>
                            <div class="support-topic-desc">তথ্য সুরক্ষা, এনক্রিপশন ও তথ্য গোপনীয়তা গ্যারান্টি</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </a>
                <a href="{{ route('refund.policy') }}" class="support-topic-item">
                    <div class="support-topic-left">
                        <div class="support-topic-icon" style="background: rgba(245, 158, 11, 0.12); color: #D97706;">
                            <i data-lucide="rotate-ccw" class="icon"></i>
                        </div>
                        <div>
                            <div class="support-topic-title">রিফান্ড ও ক্যান্সেলেশন নীতি (Refund Policy)</div>
                            <div class="support-topic-desc">টপ-আপ ফেইলিওর রিফান্ড, ওয়ারেন্টি ও বিকাশ রিভার্সাল টাইমলাইন</div>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="icon chevron"></i>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- ===================== LIVE CHAT SLIDE-OVER MODAL ===================== -->
<div id="support-chat-modal" class="support-chat-overlay" aria-hidden="true">
    <div class="support-chat-pane">
        <!-- Chat Header matching Shaako Support Screenshot -->
        <div class="support-chat-header">
            <div class="support-chat-brand">
                <div class="support-chat-avatar-wrap">
                    <i data-lucide="headphones" class="icon"></i>
                    <span class="support-chat-online-dot"></span>
                </div>
                <div>
                    <div class="support-chat-title">
                        <span>RosTop Support</span>
                        <i data-lucide="check-circle-2" class="icon verified-badge" title="Verified Support"></i>
                    </div>
                    <div class="support-chat-meta">24/7 Customer help &amp; assistance</div>
                </div>
            </div>
            <button type="button" id="support-chat-close-btn" class="support-chat-close" aria-label="Close Chat">
                <i data-lucide="x" class="icon"></i>
            </button>
        </div>

        <!-- Chat Conversation Area -->
        <div class="support-chat-body" id="support-chat-messages">
            <!-- Empty State Prompt -->
            <div class="support-chat-empty">
                <div class="support-chat-empty-icon">
                    <i data-lucide="message-square" class="icon"></i>
                </div>
                <div class="support-chat-empty-text">No conversations yet</div>
                <p class="support-chat-empty-sub">
                    কীভাবে আপনাকে সাহায্য করতে পারি? নিচের অপশন বেছে নিন অথবা সরাসরি মেসেজ লিখুন।
                </p>

                <!-- Quick Help Pills -->
                <div class="support-quick-pills">
                    <button type="button" class="quick-pill-btn" data-msg="আমার অর্ডারের বর্তমান অবস্থা জানতে চাই">
                        📦 ট্র্যাক অর্ডার
                    </button>
                    <button type="button" class="quick-pill-btn" data-msg="পেমেন্ট বা রিফান্ড সংক্রান্ত সাহায্য প্রয়োজন">
                        💰 পেমেন্ট ও রিফান্ড
                    </button>
                    <button type="button" class="quick-pill-btn" data-msg="গিফট কার্ডের এক্সচেঞ্জ রেট জানতে চাই">
                        ⚡ গিফট কার্ড রেট
                    </button>
                    <a href="https://wa.me/8801700000000?text=Hello%20RosTop%20Support%2C%20I%20need%20help" target="_blank" rel="noopener noreferrer" class="quick-pill-btn whatsapp-pill">
                        <i data-lucide="message-circle" class="icon"></i> হোয়াটসঅ্যাপে লাইভ চ্যাট
                    </a>
                </div>
            </div>
        </div>

        <!-- Chat Footer & Input Box -->
        <div class="support-chat-footer">
            <form id="support-chat-form" class="support-chat-input-row" onsubmit="event.preventDefault(); window.sendChatMessage();">
                <input type="text" id="support-chat-input" class="support-chat-input" placeholder="আপনার বার্তাটি লিখুন..." autocomplete="off">
                <button type="submit" class="support-chat-send-btn" aria-label="Send Message">
                    <i data-lucide="send" class="icon"></i>
                </button>
            </form>
            <div class="support-chat-direct-wa">
                <span>অথবা দ্রুত উত্তরের জন্য:</span>
                <a href="https://wa.me/8801700000000?text=Hello%20RosTop%20Support" target="_blank" rel="noopener noreferrer">
                    <i data-lucide="message-circle" class="icon" style="width: 13px; height: 13px;"></i> WhatsApp Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
