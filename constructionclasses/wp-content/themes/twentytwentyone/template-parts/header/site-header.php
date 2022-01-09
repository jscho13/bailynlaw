<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>

<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">


  <div class="row short_row">

    <div id="mobile-menu" class="menu">

      <nav class="navbar navbar-expand-lg navbar-dark black-bg fixed-top">

        <a class="navbar-brand" href="https://bailynlaw.com/">

          <div id="bailyn-law">

            <div class="title">Bailyn Law</div>

            <hr class="brand-line"/>

            <div class="catch-phrase">

              SOLVING PROBLEMS AND RESOLVING <br/>DISPUTES FOR ENTREPRENEURS

            </div>

          </div>

        </a>

        <a href="tel:+16463269971" class="nav-phone mobile-only">646-326-9971</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">

          <span class="navbar-toggler-icon"></span>

        </button>





        <div class="collapse navbar-collapse" id="collapsibleNavbar">



          <div id="newsletter-signup">

            <div id="subscribeToNewsletter">

              <div id="social-icons">

                <a href="https://twitter.com/bradbailyn" target="_blank"><i aria-hidden="true" class="fa fa-twitter social-icon"></i></a>



                <a href="https://www.youtube.com/channel/UC79VCBYEtDJkl6wv_JfvVxQ?view_as=subscriber" target="_blank"><i aria-hidden="true" class="fa fa-youtube social-icon"></i></a>



                <a href="Linkedin.com/in/bradleybailyn" target="_blank"><i aria-hidden="true" class="fa fa-linkedin social-icon"></i></a>



                <a href="https://www.facebook.com/bailynlaw/  " target="_blank"><i aria-hidden="true" class="fa fa-facebook social-icon"></i></a>



              </div>



            </div>

          </div>



          <ul class="navbar-nav ml-auto">

            <li class="nav-item">

            <a class="nav-link" href="https://bailynlaw.com/">Home</a>

            </li>	  



            <!-- MEGA Dropdown -->

            <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="#services-mega-menu-header">Services</a>				

            <ul id="services-mega-menu-header" class="dropdown-menu">

              <li>

              <a class="services-header" href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/">Bankruptcy</a>

              <ul class="services-submenu">

                <li>

                <a class="services-header" href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/consumer-bankruptcy/">Consumer Bankruptcy</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/im-thinking-about-filing-a-chapter-7-proceeding-can-i-discharge-my-income-tax-debt/">Chapter 7 Bankruptcy</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/chapter-13-bankruptcy/">Chapter 13 Bankruptcy </a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/car-loan-debt/">Car Loan Debt </a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/medical-debt/">Medical Debt </a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/correcting-credit-report-errors/">Credit Card </a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/foreclosure/">Foreclosure</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/gambling-debts/">Gambling Debts</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/mortgage-debt/">Mortgage Debt</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/tax-irs-debt/">Tax/IRS Debt</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/leases-timeshares/">Leases &amp; Timeshares</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/one-two-punch-lien-lawsuit/">Liens &amp; Judgements</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/personal-guarantees/">Personal Guarantees</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/people-with-disabilities/">People with Disabilities</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/secured-loans-debts/">Secured Loans/ Debts</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/unsecured-loans-debts/">Unsecured Loans / Debts</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/credit-repair/">Credit Repair</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/veterans-active-military-members/">Veterans &amp; Active Military Members</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/loan-modification/">Loan Modification</a>

                    </li>



                  </ul>

                </div>

                </li>

                <li>

                <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/corporate-bankruptcy/" class="services-header">Corporate Bankruptcy &amp; Debt Workouts</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                <div id="CorporateBankruptcy" class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/small-businesses-commercial-tenants/">Small Business</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/corporate/">Corporate</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/llc/">LLC</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/im-thinking-about-filing-a-chapter-7-proceeding-can-i-discharge-my-income-tax-debt/">Chapter 7</a>

                    </li>												

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/business-loans/">Business Loans</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/tax-debt/">Tax Debt</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/restructure-debt/">Restructure Debt</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/lawsuit-judgments-debt/">Lawsuit &amp; Judgments Debt</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/lease-agreements/">Lease Agreements</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/layoffs/">Layoffs</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/business-bankruptcy-contracts/">Contracts</a>

                    </li>



                  </ul>

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/fraudulent-conveyance-actions/">Fraudulent Conveyance Actions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/non-dischargeability-actions/">Non-Dischargeability Actions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/preferential-transfer-actions/">Preferential Transfer Actions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/objections-to-discharge/">Objections to Discharge</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/wage-garnishment/">Wage Garnishment</a>

                    </li>

                  </ul>

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/bankruptcy-avoidance-litigation/">Bankruptcy Avoidance Litigation</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/loan-modification-debt-restructuring/">Loan Modification &amp; Debt Restructuring</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/out-of-court-workouts-turnarounds/">Out-of-court Workouts &amp; Turnarounds</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/state-federal-receiverships-dissolutions/">State and Federal Receiverships and Dissolutions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/deed-in-lieu-transactions/">Deed-in-lieu transactions</a>

                    </li>

                  </ul>

                </div>

                </li>

                <li>

                <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/creditor-and-trustee-representation/" class="services-header" class="services-header">Creditor &amp; Trustee Representation</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                <div id="CreditorTrusteeRepresentation" class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/secured-creditors-landlords/">Secured Creditors &amp; Landlords</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/creditor-trustee-representation-preferential-transfer-actions/">Preferential Transfer Actions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/creditor-trustee-representation-fraudulent-conveyance-actions/">Fraudulent Conveyance Actions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/creditor-trustee-representation-non-dischargeability-actions/">Non-Dischargeability Actions</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/trustee-services/">Trustee Services</a>

                    </li>



                  </ul>

                </div>

                </li>

                <li>

                <a class="services-header" href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/corporate-bankruptcy/">Industries We Serve</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/a-financial-makeover-for-new-yorks-bars-and-nightclubs-chapter-11-bankruptcy/">Bars and Nightclubs</a>

                    </li>						

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/individuals-sole-proprietors/">Individuals &amp; Sole Proprietors</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/small-businesses-commercial-tenants/">Small Businesses &amp; Commercial Tenants</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/what-new-york-city-bakeries-should-know-about-chapter-11-bankruptcy/">Bars, Restaurants &amp; Bakeries</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/new-york-city-grocery-stores-use-chapter-11-bankruptcy-to-rebuild-and-rebrand/">Grocery Stores</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/plumber-hvac-chapter-11/">Plumbing &amp; HVAC</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/real-estate-development-construction/">Real Estate Dev. &amp; Construction</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/financial-insurance-companies/">Financial &amp; Insurance Companies</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/trucking-company-chapter-11/">Trucking &amp; Transportation Companies</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/recovering-your-leased-equipment-in-a-new-york-chapter-11-bankruptcy-proceeding/">Manufacturers &amp; Distributors</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-bankruptcy-lawyers-business-restructuring-chapter-7-11-13-attorneys/healthcare-facilities/">Healthcare Facilities</a>

                    </li>



                  </ul>

                </div>

                </li>

              </ul>

              </li>

              <li>

              <a class="services-header" href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/">Commercial Litigation</a>

              <ul class="services-submenu">

                <li>

                <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/business-litigation-and-commercial-arbitration/" class="services-header">Business Litigation &amp; Commercial Arbitration</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/collections-demand-letters/">Collections &amp; Demand Letters</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/cease-desist-letters/">Cease &amp; Desist Letters</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/domain-intellectual-property-disputes/">Domain &amp; Intellectual Property Disputes</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/online-defamation-slander/">Online Defamation &amp; Slander</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/partnership-disputes/">Partnership Disputes</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/fraud-theft/">Fraud &amp; Theft</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/employee-litigation/">Employee Litigation</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/non-compete-enforcement/">Non-Compete Enforcement</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/commercial-lease-litigation/">Commercial Lease Litigation</a>

                    </li>

                  </ul>

                </div>

                </li>

                <li>

                <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/collections-and-judgment-enforcement/">Collections &amp; Judgment Enforcement</a>

                </li>

                <li>

                <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/real-estate-and-landlord-tenant-litigation/" class="services-header">Commercial Lease &amp; Real Estate Disputes</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/break-leases/">Break Leases</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/lease-review-negotiation/">Lease Review &amp; Negotiation</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/real-estate-financing-agreements/">Real Estate Financing Agreements</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/building-purchase-sale/">Building Purchase &amp; Sale</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/subtenants-shared-spaces/">Subtenants &amp; Shared Spaces</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/construction-contracts/">Construction Contracts</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/office-leases/">Office Leases</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/manufacturing-industrial-spaces/">Manufacturing &amp; Industrial Spaces</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/retail-leases/">Retail Leases</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/healthcare-leases/">Healthcare Leases</a>

                    </li>

                  </ul>

                  </li>

                  <li>

                  <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/wrongful-insurance-claim-denials/">Wrongful Insurance Claim Denials</a>

                  </li>			

                </ul>

                </li>

                <li>

                <a class="services-header" href="https://bailynlaw.com/nyc-startup-and-small-business-law/"><!--Corporate &amp; Non-Profit Law-->Business Contracts &amp; Transactions </a>

                <ul class="services-submenu">

                  <li>

                  <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/contracts-and-agreements/" class="services-header">Contracts and Agreements</a>

                  <a class="inner-sub-menu-plus inner-menu-trigger" id="">+</a>

                  <div class="inner-menu-hidden hidden-bg">

                    <ul class="services-submenu-submenu">

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/assoc-supplier-vendor-contracts/">Assoc &amp; Supplier Vendor Contracts</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/financial-services-agreements/">Financial Services Agreements</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/equipment-leases/">Equipment Leases</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/marketing-pr-agreements/">Marketing &amp; PR Agreements</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/software-licensing-agreements/">Software Licensing Agreements</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/business-process-outsourcing-contracts/">Business Process Outsourcing (BPO) Contracts</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/contract-review-with-written-comments/">Contract Review w/ Written Comments</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/contract-drafting/">Contract Drafting</a>

                      </li>

                      <li>

                      <a href="https://bailynlaw.com/nyc-business-lawyers-corporate-attorneys-ma-buy-sell-due-diligence-bailyn-law/contract-negotiation/">Contract Negotiation</a>

                      </li>

                    </ul>

                  </div>

                  </li>
                </ul>

                </li>

                <li>

                <a class="services-header" href="https://bailynlaw.com/estate-planning/">Trusts &amp; Estates Litigation</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="trusts-and-estates-litigation-menu-link">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu closed-submenu">

                    <li>

                    <a href="https://bailynlaw.com/estate-planning/challenge-a-trustee-investment-manager-or-other-fiduciary/">Challenge a Fiduciary</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/estate-planning/contest-a-will-or-trusts/">Contest a Will or Trust</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/estate-planning/legal-representation-for-estate-administrators/">Legal Representation For Estate Administrators</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/estate-planning/make-a-claim-under-a-will/">Make a Claim Under a Will</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/estate-planning/plan-your-estate/">Plan Your Estate</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/estate-planning/trusts/">Trusts</a>

                    </li>

                  </ul>

                </div>

                </li>

                <li>

                <a class="services-header" href="https://bailynlaw.com/nyc-commercial-real-estate-attorneys-business-lease-lawyers/">Residential Real Estate Law</a>

                </li>

                <li>

                <a class="services-header" href="https://bailynlaw.com/tax-law-nyc-nys-irs/">Tax Law: NYC, NYS &amp; IRS</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="trusts-and-estates-litigation-menu-link">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu closed-submenu">

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/ny-individual-and-business-tax-audits/">Individual and Business Tax Audits</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/nys-and-nyc-residency-audits/">NYS and NYC Residency Audits</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/conciliation-conferences/">Conciliation Conferences</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/voluntary-disclosures/">Voluntary Disclosures</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/sales-and-use-tax/">Sales and Use Tax</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/responsible-person-assessments/">Responsible Person Assessments</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/llc-responsible-person-assessment/">LLC Responsible Person Assessment</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/warrants-levies-and-seizures/">Warrants, Levies, and Seizures</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/installment-payment-agreements/">Installment Payment Agreements</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/ny-offers-in-compromise/">Offers in Compromise</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/drivers-license-suspension/">Driver’s License Suspension</a>

                    </li>			

                  </ul>	

                  <ul class="services-submenu-submenu">

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/irs-individual-and-business-tax-audits/">Individual and Business Tax Audits</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/penalty-abatement-requests/">Penalty Abatement Requests</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/assistance-for-non-filers/">Assistance for Non-Filers</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/federal-tax-liens/">Federal Tax Liens</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/levies-and-wage-garnishments/">Levies and Wage Garnishments</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/collection-due-process-hearings/">Collection Due Process Hearings</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/installment-agreements/">Installment Agreements</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/irs-offers-in-compromise/">Offers in Compromise</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/trust-fund-recovery-penalties/">Trust Fund Recovery Penalties</a>

                    </li>

                    <li>

                    <a href="https://bailynlaw.com/tax-law-nyc-nys-irs/innocent-spouse-relief-claims/">Innocent Spouse Relief Claims</a>

                    </li>

                  </ul>

                </div>

                </li>

                <li>

                <a class="services-header" href="https://bailynlaw.com/nyc-corporate-legal-services/">Training Seminars</a>

                <a class="inner-sub-menu-plus inner-menu-trigger" id="trusts-and-estates-litigation-menu-link">+</a>

                <div class="inner-menu-hidden hidden-bg">

                  <ul class="services-submenu closed-submenu">

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/new-employee-onboarding/">New Employee Onboarding</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/sexual-harassment/">Sexual Harassment</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/discrimination/">Discrimination</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/data-protection/">Data Protection</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/hr-benefits/">HR &amp; Benefits</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/legal-compliance/">Legal Compliance</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/confidentiality-trade-secrets/">Confidentiality &amp; Trade Secrets</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/hipaa/">HIPAA</a>

                    </li>	

                    <li>

                    <a href="https://bailynlaw.com/nyc-corporate-legal-services/custom-seminars/">Custom Seminars</a>

                    </li>			

                  </ul>

                </div>

                </li>

              </ul>



              </li>	  





              <!-- Dropdown -->

              <li class="nav-item dropdown">

              <a class="nav-link dropdown-toggle" href="https://bailynlaw.com/about-us" id="navbardrop" data-toggle="dropdown">

                About Us

              </a>

              <div class="dropdown-menu">

                <a class="dropdown-item" href="/about-us/our-mission/">Our Mission</a>

                <a class="dropdown-item" href="/about-us/about-bradley-bailyn">About Bradley Bailyn</a>

              </div>

              </li>		  

              <!-- Dropdown -->

              <li class="nav-item dropdown">

              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">

                Resources

              </a>

              <div class="dropdown-menu">

                <a class="dropdown-item" href="https://bailynlaw.com/bradley-bailyns-guide-to-commercial-litigation-in-new-york-city">NYC Financial Law Attorney Blog</a>

                <a class="dropdown-item" href="https://bailynlaw.com/vlog/think-like-a-lawyer">

                  #ThinkLikeALawyer Vlog

                </a>

                <a class="dropdown-item" href="https://bailynlaw.com/constructionclasses/">

                  Construction Classes

                </a>

              </div>

              </li>

              <li class="nav-item">

              <a class="nav-link" href="https://bailynlaw.com/contact">Contact</a>

              </li>

              <li class="nav-item">

              <a class="nav-link" href="tel:+16463269971">646-326-9971</a>

              </li>
              <!--<li class="nav-item">

      <a class="nav-link btn btn-primary" style="background-color:rgba(239,202,0,1) !important; border-color:rgba(239,202,0,1) !important; color:black !important;" target="_blank" href="https://lp.constantcontactpages.com/su/wSjFP2O">Send me the monthly class list</a>

      </li>-->

            </ul>

          </div>  

        </nav>

      </div>

    </div>	




<script>



var clicked = 0;

jQuery('#services-mega-menu-header .inner-menu-hidden').hide();


jQuery('#services-mega-menu-header .inner-menu-trigger').click(function(){



  clicked = 1;



  jQuery(this).closest('#services-mega-menu-header .inner-sub-menu-plus').html(jQuery(this).closest('#services-mega-menu-header .inner-sub-menu-plus').text() == '+' ? '-' : '+');

  jQuery(this).next('#services-mega-menu-header .inner-menu-hidden').toggle();

  });

    </script>

    <?php get_template_part( 'template-parts/header/site-branding' ); ?>
    <?php get_template_part( 'template-parts/header/site-nav' ); ?>

  </header><!-- #masthead -->
