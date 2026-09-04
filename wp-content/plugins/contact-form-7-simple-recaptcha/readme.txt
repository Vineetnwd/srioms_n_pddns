=== LukasApps CAPTCHA tools for Contact Form 7 ===
Contributors: 247wd
Tags: contact form 7, captcha, recaptcha, hcaptcha, cloudflare turnstile
Requires at least: 6.2
Tested up to: 7.0.2
Stable tag: 0.1.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Protect your Contact Form 7 forms with **Google reCAPTCHA V2**, **Google reCAPTCHA V3**, **hCAPTCHA**, or **Cloudflare Turnstile**.

Easy integration and supports multiple forms on a single page.

## Four CAPTCHA Options

Choose the CAPTCHA provider that works best for you:

- **Google reCAPTCHA V2** — Google's classic "I'm not a robot" checkbox.
- **Google reCAPTCHA V3** — Google's invisible, score-based bot verification.
- **hCAPTCHA** — A privacy-first alternative that offers robust bot protection while keeping user data secure.
- **Cloudflare Turnstile** — A modern CAPTCHA that verifies users in the background, only requiring a simple click if the visitor appears suspicious.

## Simple Setup

1. Sign up with your chosen CAPTCHA provider and grab your Site Key and Secret Key.
2. Paste them into **CF7 Captcha** in your WordPress admin.
3. Add protection to any CF7 form in seconds using the shortcode provided in the same settings page.

## Customizable Appearance

Each CAPTCHA widget supports customization options directly from the shortcode:

- **Size** — Choose between normal and compact to fit your form layout.
- **Theme** — Switch between light and dark themes (or auto for Turnstile) to match your site's design.
- **Language** — Force any CAPTCHA to render in a specific language for your audience.

All options are combinable, so you can mix and match to get the exact look you need.

## Submission Insights (NEW in v0.1.7)

Go beyond just blocking spam. Submission Insights gives you full visibility into every form submission:

- **Sender IP** — See the IP address of the person who contacted you.
- **Source Page** — Know exactly which page on your site the form was filled out on.
- **Device & Browser** — Get technical details about the sender's setup.

== Want More? Upgrade to CF7 Captcha Pro ==

This free version gives you solid CAPTCHA protection. **CF7 Captcha Pro** adds six extra layers of spam defense on top of what you already have here, plus a full set of tools to capture and act on every lead your forms collect.

=== What you get with Pro ===

**6-Layer Spam Defense** — additional spam-blocking methods that work quietly in the background:
- **Advanced Honeypot** — invisible trap fields with names that regenerate every 24 hours.
- **Time Limit Validation** — bots submit in 0.2 seconds. Humans take 15–30. This blocks anything that moves too fast (or stays too long).
- **Rate Limiting** — caps submissions per IP so bot networks can't flood your inbox or burn through your email quota.
- **Geographic Blocking** — whitelist only the countries you serve, or blacklist known spam regions.
- **IP Pattern Blocking** — block single IPs, wildcards, CIDR ranges, or entire subnets when you know exactly where an attack is coming from.
- **Word Filter** — scans every submission for spam keywords, phishing URLs, and known scam phrases before it reaches you.

**Lead Recovery** — captures form data in real-time as visitors type, so you don't lose leads from abandoned forms.

**Database Storage & Export** — every submission is saved with full metadata (IP, browser, referrer, timestamp). Export to CSV, Excel, JSON, or PDF whenever you need it. No more lost leads if your email fails.

**Webhooks** — send form data instantly to any URL. Connect to Zapier, Salesforce, Slack, Google Sheets, or any custom API. Multiple webhooks per form, with retry logic built in.

**Mailchimp Integration** — submissions automatically added to your Mailchimp lists. Field mapping, tags, opt-in handling.

**Twilio SMS** — receive instant alerts for every submission or send automated SMS replies to your clients.

**Comprehensive Logging** — every spam block, webhook call, and integration event is logged. Debug any issue in minutes instead of hours.

👉 **[Get CF7 Captcha Pro](https://lukasapps.de/wordpress/plugins/cf7-captcha-pro/)**

== External services ==

This plugin relies on third-party CAPTCHA providers to detect and block spam submissions on your Contact Form 7 forms. Only the service(s) you configure and activate in the plugin settings are contacted.

**Google reCAPTCHA (v2 and v3)**
This plugin loads the Google reCAPTCHA script and sends the CAPTCHA response token to Google's verification API when a protected form is submitted, in order to confirm the submission is not from a bot. The visitor's IP address is also sent as part of this verification.
This service is provided by Google: [Terms of Service](https://policies.google.com/terms), [Privacy Policy](https://policies.google.com/privacy).

**hCaptcha**
This plugin loads the hCaptcha script and sends the CAPTCHA response token to hCaptcha's verification API when a protected form is submitted, in order to confirm the submission is not from a bot.
This service is provided by hCaptcha: [Terms of Service](https://www.hcaptcha.com/terms), [Privacy Policy](https://www.hcaptcha.com/privacy).

**Cloudflare Turnstile**
This plugin loads the Cloudflare Turnstile script and sends the CAPTCHA response token to Cloudflare's verification API when a protected form is submitted, in order to confirm the submission is not from a bot.
This service is provided by Cloudflare: [Terms of Service](https://www.cloudflare.com/website-terms/), [Privacy Policy](https://www.cloudflare.com/privacypolicy/).

These services are only contacted when the corresponding CAPTCHA type is enabled and configured with valid API keys.

== Installation ==

1. Upload the entire contents of the zip file to your plugin directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure plugin from Admin => CF7 Captcha

== Changelog ==

= 0.1.8 =
* Fix: Updated "Requires at least" version to match plugin headers and readme.
* Fix: Reduced tags list to comply with the 5-tag limit.
* Improvement: Documented third-party services (Google reCAPTCHA, hCaptcha, Cloudflare Turnstile) in the readme.
* Improvement: Revised plugin description to remove unverifiable marketing claims.
* Security: Added proper output escaping to shortcode callbacks to prevent XSS.

= 0.1.7 =
* New: Introduced [cf7sr-insights] tag - easily collect sender's IP, Source Page, and Browser info.
* New: Added support for Google reCAPTCHA v3 Invisible
* Improvement: Security upgrade - Switched CAPTCHA verification to POST method.
* Improvement: Enhanced bot detection by including 'remoteip' in API verification calls.
* Improvement: Performance boost - Optimized form validation to bypass expensive shortcode rendering.
* Improvement: Cleaned up and consolidated language files for a smaller plugin footprint.
* Fix: Modernized script enqueuing system to eliminate conflicts with modern themes/popups.
* Fix: Corrected Hungarian translation and refined admin notice dismissal behavior.
* Fix: Resolved a bug in the admin notice dismissal logic.
