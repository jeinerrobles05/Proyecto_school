@extends('admin.layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.settings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{ trans('admin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.settings') }}</div>
            </div>
        </div>

<div class="section-body">
            <h2 class="section-title">Controlar todo</h2>
            <p class="section-lead">
                Puede cambiar todos los parámetros y variables utilizando las siguientes tarjetas.
            </p>

            <div class="row">
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="card-body">
                                <h4>General</h4>
                                <p>Cambie el título del sitio web, el logotipo, el idioma, RTL, cuentas sociales, estilos de diseño, precarga.</p>
                                <a href="/admin/settings/general" class="card-cta">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-body">
                                <h4>Financiero</h4>
                                <p>Defina tasas de comisión, impuestos, pago, moneda, pasarelas de pago, pago fuera de línea</p>
                                <a href="/admin/settings/financial" class="card-cta">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="card-body">
                                <h4>Personalización</h4>
                                <p>Cambie los fondos de página, las secciones de inicio, los estilos de héroes, las imágenes y textos.</p>
                                <a href="/admin/settings/personalization/page_background" class="card-cta">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-body">
                                <h4>Notificaciones</h4>
                                <p>Asigne plantillas de notificación a los procesos.</p>
                                <a href="/admin/settings/notifications" class="card-cta">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="card-body">
                                <h4>SEO</h4>
                                <p>Defina el título SEO, la meta descripción y el acceso de rastreo del motor de búsqueda para cada página.</p>
                                <a href="/admin/settings/seo" class="card-cta">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4>Personalización</h4>
                                <p>Definir Códigos CSS y JS adicionales.</p>
                                <a href="/admin/settings/customization" class="card-cta text-primary">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4>Update App</h4>
                                <p>Actualice su plataforma a la última versión fácilmente (deshabilitar: nullcave.club)</p>
                                <a href="/admin/settings/update-app" class="card-cta text-primary">Cambiar Ajustes<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                            </div>
        </div>
    </section>
@endsection
