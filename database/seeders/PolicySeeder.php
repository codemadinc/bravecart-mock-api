<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            [
                'title' => 'Privacy Policy',
                'handle' => 'privacy-policy',
                'body' => '<h2>Privacy Policy</h2><p>Last updated: April 1, 2026</p><p>At Pilot Demo Store, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p><h3>Information We Collect</h3><p>We collect information you provide directly, such as your name, email address, shipping address, and payment information when you make a purchase.</p><h3>How We Use Your Information</h3><p>We use the information to process orders, communicate with you about your purchases, and improve our services.</p><h3>Data Security</h3><p>We implement appropriate security measures to protect your personal information.</p>',
            ],
            [
                'title' => 'Shipping Policy',
                'handle' => 'shipping-policy',
                'body' => '<h2>Shipping Policy</h2><p>Last updated: April 1, 2026</p><h3>Processing Time</h3><p>Orders are processed within 1-2 business days. You will receive a confirmation email with tracking information once your order ships.</p><h3>Shipping Rates</h3><p><strong>Standard Shipping (5-7 business days):</strong> $5.99 or FREE on orders over $100</p><p><strong>Express Shipping (2-3 business days):</strong> $14.99</p><p><strong>Overnight Shipping (1 business day):</strong> $24.99</p><h3>International Shipping</h3><p>We ship to select international destinations. Rates and delivery times vary by location.</p>',
            ],
            [
                'title' => 'Refund Policy',
                'handle' => 'refund-policy',
                'body' => '<h2>Refund Policy</h2><p>Last updated: April 1, 2026</p><h3>Returns</h3><p>We accept returns within 30 days of delivery. Items must be unworn, unwashed, and in original condition with tags attached.</p><h3>How to Return</h3><p>Contact us at returns@pilotdemo.store to initiate a return. We will provide a prepaid shipping label for domestic returns.</p><h3>Refunds</h3><p>Refunds are processed within 5-7 business days of receiving your return. The refund will be applied to your original payment method.</p><h3>Exchanges</h3><p>We offer free exchanges for different sizes or colors, subject to availability.</p>',
            ],
            [
                'title' => 'Terms of Service',
                'handle' => 'terms-of-service',
                'body' => '<h2>Terms of Service</h2><p>Last updated: April 1, 2026</p><p>By accessing and using this website, you accept and agree to be bound by these Terms of Service.</p><h3>Use of Website</h3><p>You may use this website for lawful purposes only. You must not use this website in any way that causes damage to the website or impairs its availability.</p><h3>Intellectual Property</h3><p>All content on this website, including text, images, and logos, is the property of Pilot Demo Store and is protected by copyright law.</p><h3>Limitation of Liability</h3><p>Pilot Demo Store shall not be liable for any indirect, incidental, or consequential damages arising from your use of this website.</p>',
            ],
        ];

        foreach ($policies as $policyData) {
            $policyData['store_id'] = 1;
            Policy::create($policyData);
        }
    }
}
