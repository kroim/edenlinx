@extends('layouts.master1')
@section('title', $title)
@section('menuitem', $title)
@section('dashboardcontent')
    Please Select Package
    <div class="row">

        <div class="col-md-12">
            <div class="pricing-container margin-top-30">

                <!-- Plan #1 -->

                <div class="plan">

                    <div class="plan-price">
                        <h3>Basic</h3>
                        <span class="value">Free</span>
                        <span class="period">Free of charge one standard listing active for 30 days</span>
                    </div>

                    <div class="plan-features">
                        <ul>
                            <li>One Listing</li>
                            <li>30 Days Availability</li>
                            <li>Standard Listing</li>
                            <li>Limited Support</li>
                        </ul>
                        <a class="button border" href="#">Get Started</a>
                    </div>

                </div>

                <!-- Plan #3 -->
                <div class="plan featured">

                    <div class="listing-badge">
                        <span class="featured">Featured</span>
                    </div>

                    <div class="plan-price">
                        <h3>Extended</h3>
                        <span class="value">$9.99</span>
                        <span class="period">One time fee for one listing, highlighted in the search results</span>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li>One Time Fee</li>
                            <li>One Listing</li>
                            <li>90 Days Availability</li>
                            <li>Featured In Search Results</li>
                            <li>24/7 Support</li>
                        </ul>
                        <a class="button" href="#">Get Started</a>
                    </div>
                </div>

                <!-- Plan #3 -->
                <div class="plan">

                    <div class="plan-price">
                        <h3>Professional</h3>
                        <span class="value">$19.99</span>
                        <span class="period">Monthly subscription for unlimited listings and availability</span>
                    </div>

                    <div class="plan-features">
                        <ul>
                            <li>Unlimited Listings</li>
                            <li>Unlimited Availability</li>
                            <li>Featured In Search Results</li>
                            <li>24/7 Support</li>
                        </ul>
                        <a class="button border" href="#">Get Started</a>
                    </div>
                </div>

                <!-- Plan #4 -->
                <div class="plan">

                    <div class="plan-price">
                        <h3>Professional</h3>
                        <span class="value">$29.99</span>
                        <span class="period">Monthly subscription for unlimited listings and availability</span>
                    </div>

                    <div class="plan-features">
                        <ul>
                            <li>Unlimited Listings</li>
                            <li>Unlimited Availability</li>
                            <li>Featured In Search Results</li>
                            <li>24/7 Support</li>
                        </ul>
                        <a class="button border" href="#">Get Started</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="copyrights">© 2017 Listeo. All Rights Reserved.</div>
        </div>
    </div>

@endsection
