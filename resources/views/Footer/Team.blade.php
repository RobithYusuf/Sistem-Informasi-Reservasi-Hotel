@extends('Layout.Semua')

@section('Title', 'Our Team')

@section('Konten')
<div class="container">
    <div class="row-team">
        <div class="column-team toc-column">
            <div class="table-of-contents">
            <h3>Table of Contents</h3>
            <ul>
                <li><a href="#ceo" onclick="scrollToSection('ceo')">CEO & Founder</a></li>
                <li><a href="#Manager" onclick="scrollToSection('Manager')">Manager</a></li>
                <li><a href="#HoD" onclick="scrollToSection('HoD')">Head of Division</a></li>
                <li><a href="#Staff" onclick="scrollToSection('Staff')">Staff</a></li>
            </ul>
            </div>
        </div>

        <section id="ceo">
            <div class="column-team single-card mt-3">
                <div class="card" id="card-team">
                    <img src="{{ asset('img/profil kosong.png') }}" alt="Jane" style="width:100%">
                        <div class="container-team">
                        <h2>Reno Saputra</h2>
                        <p class="title-team">CEO &amp; Founder</p>
                        <p>Some text that describes about me and my job.</p>
                        <p>example@example.com</p>
                        <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
        </section>
    </div>
        
    <section id="Manager">
        <div class="row-team">
            <div class="column-team single-card">
                <div class="card" id="card-team">
                    <img src="{{ asset('img/profil kosong.png') }}" alt="Mike" style="width:100%">
                        <div class="container-team">
                            <h2>Firman Ramadhan</h2>
                            <p class="title-team">Manager</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section id="HoD">
    <h2 class="staff mx-2 mb-3 bg-primary">Head of Division</h2>
        <div class="row-team">
            <div class="column-team">
                <div class="card" id="card-team">
                    <img src="{{ asset('img/profil kosong.png') }}" alt="John" style="width:100%">
                        <div class="container-team">
                            <h2>Retno</h2>
                            <p class="title-team">Head of Division<br>(Front Office)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <img src="{{ asset('img/profil kosong.png') }}" alt="David" style="width:100%">
                        <div class="container-team">
                            <h2>Kamporisdon</h2>
                            <p class="title-team">Head of Division<br>(Housekeeping)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <img src="{{ asset('img/profil kosong.png') }}" alt="Emily" style="width:100%">
                        <div class="container-team">
                            <h2>Dermawan</h2>
                            <p class="title-team">Head of Division<br>(Security)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <img src="{{ asset('img/profil kosong.png') }}" alt="Chris" style="width:100%">
                        <div class="container-team">
                            <h2>Restaurant</h2>
                            <p class="title-team">Head of Division<br>(Restaurant)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- staff row 1 -->
    <section id="Staff">
        <h2 class="staff mx-2 mb-3 bg-primary">Staff</h2>
        <div class="row-team">
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Sarah" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Bagus Pamuji</h2>
                            <p class="title-team">Staff (Front Office)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Ryan" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Salman Fadil</h2>
                            <p class="title-team">Staff (Housekeeping)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Mia" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Dian Pramana</h2>
                            <p class="title-team">Staff (Security)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Kevin" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Handika Putra</h2>
                            <p class="title-team">Staff (Restaurant)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
        </div>

        <!-- staff row 2 -->
        <div class="row-team">
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Sarah" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Lusiana Wati</h2>
                            <p class="title-team">Staff (Front Office)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Ryan" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Baharuddin</h2>
                            <p class="title-team">Staff (Housekeeping)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Mia" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Rifaldo Alif</h2>
                            <p class="title-team">Staff (Security)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Kevin" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Iwet Lidia</h2>
                            <p class="title-team">Staff (Restaurant)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
        </div>

        <!-- staff row 3 -->
        <div class="row-team">
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Sarah" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Murni Tarigan</h2>
                            <p class="title-team">Staff (Front Office)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Ryan" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Anata Musadi</h2>
                            <p class="title-team">Staff (Housekeeping)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Mia" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Irwanto</h2>
                            <p class="title-team">Staff (Security)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Kevin" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Yudha Alfarizi</h2>
                            <p class="title-team">Staff (Restaurant)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
        </div>

        <!-- staff row 4 -->
        <div class="row-team">
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Sarah" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Adi Susilo</h2>
                            <p class="title-team">Staff (Front Office)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Ryan" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Khoiron</h2>
                            <p class="title-team">Staff (Housekeeping)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            <div class="column-team">
                <div class="card" id="card-team">
                    <!-- <img src="{{ asset('img/profil kosong.png') }}" alt="Mia" style="width:100%"> -->
                        <div class="container-team">
                            <h2>Wiranto</h2>
                            <p class="title-team">Staff (Security)</p>
                            <p>Some text that describes about me and my job.</p>
                            <p>example@example.com</p>
                            <p><button class="button-team">Contact</button></p>
                        </div>
                </div>
            </div>
            
        </div>
    </section>
</div>
@endsection