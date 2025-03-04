<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a class='brand-link' href='/dist/pages/'>
        <!--begin::Brand Image-->
        <img
          src="{{asset('build/assets/images/SSlogo8.png')}}"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">StaySphere</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
          {{-- Home --}}
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon bi bi-speedometer text-warning"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          {{-- Booking Calender --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-calendar text-warning"></i>
              <p>
                Booking Calendar
                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>calendar</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>Booking list</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/cards'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>Work schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/cards'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>Booking analytics</p>
                </a>
              </li>
            </ul>
          </li>
           {{-- Sales --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-cart text-warning"></i>
              <p>
                Sales
                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>Gift card sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/cards'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>All payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/cards'>
                    <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                    <p>Sales overview</p>
                </a>
              </li>
            </ul>
          </li>
           {{-- Catalogy --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-boxes text-warning"></i>
              <p>
                Catalogy
                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                  <i class="nav-icon bi bi-arrow-right text-warning"></i>
                  <p>Booking services</p>
                </a>
              </li>
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/info-box'>
                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                    <p>Gift cards</p>
                </a>
              </li>
            </ul>
          </li>
           {{-- hotel --}}
          <li class="nav-item">
             <a href="#" class="nav-link">
              <i class="nav-icon bi bi-building text-warning"></i>
              <p>
                hotel
                <i class="nav-arrow bi bi-chevron-right text-warning"></i>
              </p>
             </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                    <i class="nav-icon bi bi-map text-warning"></i>
                    <p>Property Setup
                    <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                  </p>
                </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Overview</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Property Settings</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/cards'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Room Types</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/cards'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Rate Plans</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Extras</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Tex Catagories</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Marteks</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Sales departments</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Renevue Accounts</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Promotion codes</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                          <p>Languages</p>
                        </a>
                      </li>
                    </ul>
                  </li>
               </li>
             </ul>  
             <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a class='nav-link' href='/dist/pages/widgets/small-box'>
                    <i class="nav-icon bi bi-people text-warning"></i>
                    <p>Property Mangemnet
                      <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                    </p>
                  </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Reservations</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/info-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Room Calendar</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/cards'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Inventory Calendar</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/cards'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Bulk Updates</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Channel Manager</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Guest Realtion</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Logs</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Email Temlates</p>
                          </a>
                        </li>
                    </ul>
                </li>
             </ul> 
          </li>         
          
            {{-- break line --}}
            <div >
                <ul class="nav flex-column" style="color:aliceblue">
                    <hr>
                     {{-- site and mobile app --}}
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-globe text-warning"></i>
                        <p>
                        Site and Mobile App
                        <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-server text-warning"></i>
                            <p>Website & SEO 
                            <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Website </p>
                                </a>   
                                </li>
                                <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>SEO</p>
                                </a>   
                                </li>
                                <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Site Speed</p>
                                </a>   
                                </li>
                                <li class="nav-item">
                                <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                    <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                    <p>Uptime and security</p>
                                </a>   
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                            <i class="nav-icon bi bi-phone text-warning"></i>
                            <p>Mobile app</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                            <i class="nav-icon bi bi-tag text-warning"></i>
                            <p>Logo & Brand</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class='nav-link' href='/dist/pages/widgets/info-box'>
                            <i class="nav-icon bi bi-server text-warning"></i>
                            <p>Hopp- Link in Bio</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                    {{-- inbox --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-inbox text-warning"></i>
                        <p>Inbox</p>
                        </a>
                    </li>

                     {{--customer and leads  --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people text-warning"></i>
                        <p>
                            Customers & Leads
                            <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Contects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Form & Submission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Cummunity</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Loyalty Programs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Business Email</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    {{--Marteking  --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart-line text-warning"></i>
                        <p>
                            Marketing
                            <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Marketing Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Google Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Facebook & Instagram Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Email Marketing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Social Media Marketing</p>
                                {{-- bage adding id panding --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Referral Program</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Coupons</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                     {{--Analyics  --}}
                     <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-graph-up text-warning"></i>
                        <p>
                            Analytics
                            <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/small-box'>
                            <i class="nav-icon bi bi-arrow-right text-warning"></i>
                            <p>Highlights</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p> Real Time</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Traffic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Behaviour</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Marketing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Session Recorings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Insights</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>Benchmarks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-warning"></i>
                                <p>All reports</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    {{-- Automations --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-recycle text-warning"></i>
                        <p>
                            Automations
                            <i class="nav-arrow bi bi-chevron-right text-warning"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/small-box'>
                                <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                <p>Automations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href='/dist/pages/widgets/info-box'>
                                <i class="nav-icon bi bi-arrow-right text-wrning"></i>
                                <p>Functions</p>
                            </a>
                        </li>                  
                        </ul>
                    </li>
                    <hr>
                </ul>
            </div>
         
         
            {{-- setting --}}
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-gear text-warning"></i>
                  <p>
                    Settings
                  </p>
                </a>
            </li>
              {{-- dsign site --}}
              <hr style="color: white">
            <li class="nav-item menu-open justfiy-content-center">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-brush text-warning"></i>
                  <p>
                    Design Site
                  </p>
                </a>
            </li>
        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
  <!--end::Sidebar-->