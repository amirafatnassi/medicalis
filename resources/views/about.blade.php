<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dossier médical partagé, bienvenue</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style1.css" rel="stylesheet">


  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">

  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat-list.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">



</head>

<body>

  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:dmp@newimaging.tn">dmp@newimaging.tn</a>

      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter" style="color: #7367f0;"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook" style="color: #7367f0;"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram" style="color: #7367f0;"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin" style="color: #7367f0;"></i></i></a>
      </div>
    </div>
  </div>

  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html"> </a></h1>
    </div>
  </header>

  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <h1>Bienvenue à DMP</h1>

      <a href="{{ url('/loginMedecin')}}" class="btn btn-primary rounded-pill">Espace médecin</a>
      <a href="{{ url('/loginPatient')}}" class="btn btn-primary rounded-pill">Espace patient</a>

    </div>
  </section>

  <section id="about" class="about">
    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
          <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="play-btn mb-4"></a>
        </div>

        <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
          <h3>DMP, pour qui?</h3>
          <p>Chaque personne bénéficiant d’un régime de sécurité sociale peut disposer d’un Dossier Médical Partagé. Seuls les professionnels de santé autorisés et vous-même pouvez le consulter.</p>

          <div class="icon-box">
            <div class="icon border-primary"><i class="bx bx-fingerprint" style="color: #7367f0;"></i></div>
            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Consulter vos informations de santé</p>
          </div>

          <div class="icon-box">
            <div class="icon border-primary"><i class="bx bx-gift" style="color: #7367f0;"></i></div>
            <h4 class="title"><a href="">Conserver vos informations</a></h4>
            <p class="description">Visualiser les actions réalisées sur votre DMP</p>
          </div>

          <div class="icon-box">
            <div class="icon border-primary"><i class="bx bx-atom" style="color: #7367f0;"></i></div>
            <h4 class="title"><a href="">Dine Pad</a></h4>
            <p class="description">Ajouter des données utiles à votre suivi médical</p>
          </div>

        </div>
      </div>

    </div>
  </section>

  <section id="counts" class="counts">
    <div class="container">

      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="fas fa-user-md bg-primary"></i>
            <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
            <p>Doctors</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
          <div class="count-box">
            <i class="far fa-hospital bg-primary"></i>
            <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
            <p>Departments</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="fas fa-flask bg-primary"></i>
            <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
            <p>Research Labs</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="fas fa-award bg-primary"></i>
            <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
            <p>Awards</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <section id="services" class="services">
    <div class="container">

      <div class="section-title">
        <h2>Services</h2>
        <p>Gratuit, confidentiel et sécurisé, le Dossier Médical Partagé conserve précieusement vos informations de santé en ligne.
          Il vous permet de les partager avec votre médecin traitant et tous les professionnels de santé qui vous prennent en charge, même à l’hôpital.
          Le DMP vous permet de retrouver toutes vos informations dans un même endroit.</p>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon bg-primary"><i class="fas fa-heartbeat"></i></div>
            <h4><a href="">Dossier en ligne</a></h4>
            <p>Dossier médical partagé en ligne , accessible à tout moment. Votre historique automatiquement alimenté par vos médecins traitants.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon bg-primary"><i class="fas fa-stethoscope"></i></div>
            <h4><a href="">Choisissez vos médecins</a></h4>
            <p>Pour votre sécurité, choisissez vous meme vos médecins et gérer leurs droits d'accès.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon bg-primary"><i class="fas fa-history"></i></div>
            <h4><a href="">Historiques</a></h4>
            <p>Vos antécédents médicaux (pathologie, allergies...), Vos consultations, Vos résultats d'examens (radio, analyses biologiques...)</p>
          </div>
        </div>
        <br>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon bg-primary"><i class="fas fa-unlock"></i></div>
            <h4><a href="">Pas de blocage</a></h4>
            <p>Votre médecin, n'est pas inscrit sur la platforme? Pas de problème, ajoutez vous meme vos consultations.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon bg-primary"><i class="fas fa-user"></i></div>
            <h4><a href="">Vous êtes patient ?</a></h4>
            <p>Entrez en contact avec vos médecins, discutez avec eux, envoyez-leurs vos demandes......</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon bg-primary"><i class="fas fa-user-md"></i></div>
            <h4><a href="">Vous êtes médecin ?</a></h4>
            <p>Entrez en contact avec vos patient ainsi que vos collègues.</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <section id="faq" class="faq section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Questions fréquentes</h2>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Qu'est ce que le DMP? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p>
                Le DMP est votre carnet de santé numérique. Il permet de rassembler toutes vos informations médicales détenues par votre médecin traitant, vos médecins spécialistes que vous avez consultés, votre laboratoire de biologie, les établissements de santé dans lesquels vous avez séjournés,…. Le DMP permet aussi aux professionnels de santé autorisés d’accéder aux informations utiles à votre prise en charge et de partager avec d’autres professionnels de santé des informations médicales vous concernant:
                vos antécédents (maladies, opérations…) ;
                vos allergies éventuelles ;
                les médicaments que vous prenez ;
                vos comptes rendus d'hospitalisation et de consultation ;
                vos résultats d'examens (radios, analyses biologiques…) ;
                Il s'agit d'un véritable carnet de santé toujours accessible et sécurisé. Pour être plus pratique, il est informatisé et vous en contrôlez l'accès. A part vous, seuls les professionnels de santé autorisés (médecin, infirmier, pharmacien…) peuvent le consulter.
                Vous pouvez y accéder sur internet via dmp.tn.
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed"> Qui peut bénéficier d’un DMP ?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Tous le monde peut bénéficier d’un DMP, gratuitement.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">C'est quoi le role d'un médecin traitant sur la platforme DMP? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Pour qu'un médecin quelconque peut accéder à votre dossier, vous devez l'ajouter comme étant un médecin traitant « DMP ».
                Ce statut particulier lui permet de consulter:
                consulter l'historique des accès à votre DMP, y compris ceux des autres professionnels de santé ;
                accéder aux documents que vous avez masqués dans votre DMP ;
                bloquer, à votre demande, l'accès de votre DMP à un autre professionnel de santé ;
                donner, avec votre accord, le statut de médecin traitant à un autre médecin déjà autorisé à consulter votre DMP.
                Votre médecin traitant déclaré à l’Assurance Maladie a vocation à être aussi le médecin traitant DMP. </p>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </section>

  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>DMP</h3>
            <p>
              avenue ... <br>
              cité ....<br>
              Tunisie <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> dmp@newimaging.tn<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>LGR 2021</span></strong>. All Rights Reserved
        </div>
      </div> &nbsp; &nbsp;
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter bg-primary"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook bg-primary"><i class="bx bxl-facebook "></i></a>
        <a href="#" class="instagram bg-primary"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus bg-primary"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin bg-primary"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main1.js"></script>

</body>

</html>