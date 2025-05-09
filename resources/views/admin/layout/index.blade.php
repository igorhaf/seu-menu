@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Layout do menu</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pre-visualização</h6>
                    <a class="float-right text-gray-800" target="_blank" href="{{'http://'.$user->schema_name.'.'.env('MENU_DOMAIN')}}?editor=1&preview=1">
                        <small>Visualizar em tela cheia
                        <i class="fas fa-external-link-alt fa-fw mr-2 text-gray-800"></i>
                        </small>
                    </a>
                </div>
                <div class="card-body " style="text-align: center">
                    <img src="{{asset('vendor/seumenu/img/smartphone-icon-png-mobile-photo-phone-image-mobile-frame-27.png')}}"  class="img-responsive" style="pointer-events: none; width: 100%; height: 100%; position: absolute; top: 50px; padding-bottom: 50px; left: 0px">
                    <iframe frameborder="0" id="editor-iframe"  style="min-height: 100%; padding-top: 45px; padding-bottom: 45px; width: 92%; height: 700px;" src="{{route('web-home', $user->schema_name)}}?editor=1"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><br></h1>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{route('admin-layout-update')}}">
            @csrf
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Opções de estilo</h6>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-body">

                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do fundo da busca</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-search-bar-background-color"></div>
                                                <input type="hidden" name="search_bar_background_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor dos textos da busca</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-search-bar-text-color"></div>
                                                <input type="hidden" name="search_bar_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do topo</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-top-color"></div>
                                                <input type="hidden" name="top_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do texto do topo</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-top-color-text"></div>
                                                <input type="hidden" name="top_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do fundo</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-background-color"></div>
                                                <input type="hidden" name="background_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor dos textos de título</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-title-color-text"></div>
                                                <input type="hidden" name="titles_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor dos textos de conteúdo</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-content-color-text"></div>
                                                <input type="hidden" name="content_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor dos preços</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-price-color-text"></div>
                                                <input type="hidden" name="prices_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do fundo da rodapé</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-footer-background-color"></div>
                                                <input type="hidden" name="footer_background_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do fundo dos pagamentos</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-payment-background-color"></div>
                                                <input type="hidden" name="payment_background_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor dos textos dos pagamentos</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-payment-text-color"></div>
                                                <input type="hidden" name="payment_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do fundo dos horários</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-schedule-background-color"></div>
                                                <input type="hidden" name="schedule_background_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor dos textos dos horários</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-schedule-text-color"></div>
                                                <input type="hidden" name="schedule_text_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Logomarca</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="custom-file" id="logo_input">
                                                <input type="file" name="logo" class="custom-file-input" id="customFileLang" lang="es">
                                                <label class="custom-file-label" for="customFileLang">
                                                    @if($settings->logo != null)
                                                        {{basename($settings->logo)}}
                                                    @else
                                                        Nenhuma imagem
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor do fundo da logomarca</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-logo-background-color"></div>
                                                <input type="hidden" name="logo_background_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="">Cor da borda da logomarca</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right" id="pickr-container-logo-border-color"></div>
                                                <input type="hidden" name="logo_border_color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Estilo da logomarca</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <select name="logo_style" id="logo_style" class="form-control">
                                                <option {{($settings->logo_style=='square')?'selected':''}} value="square">Quadrada</option>
                                                <option {{($settings->logo_style=='circle')?'selected':''}} value="circle">Redonda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Imagem de fundo do cabeçalho</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="custom-file" id="header_input">
                                                    <input type="file" name="header" class="custom-file-input" id="customFileLangHeader" lang="es">
                                                    <label class="custom-file-label" for="customFileLangHeader">
                                                        @if($settings->header != null)
                                                            {{basename($settings->header)}}
                                                        @else
                                                            Nenhuma imagem
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <button id="removeHeaderFile" type="button" class="btn btn-danger mr-auto">Remover</button>
                                                <input name="removeHeaderFileInput" id="removeHeaderFileInput" type="hidden" value="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-gray-100 text-black-50 shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="">Cor do fundo do cabeçalho</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="float-right" id="pickr-container-header-color"></div>
                                                    <input type="hidden" name="header_color">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-gray-100 text-black-50 shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="">Cor do texto do cabeçalho</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="float-right" id="pickr-container-header-color-text"></div>
                                                    <input type="hidden" name="header_text_color">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                    <label for="customRange1">Nível de transparência</label>
                                    <input type="range" name="header_image_transparency" value="{{(!empty($settings->header_image_transparency)?$settings->header_image_transparency:'100')}}" class="custom-range" min="0" max="100" id="transparency_header_image">
                                <br />
                                <div class="card bg-gray-100 text-black-50 shadow">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Imagem de fundo do menu</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="custom-file" id="background_input">
                                                    <input type="file" name="background_image" class="custom-file-input" id="customFileLangBackground" lang="es">
                                                    <label class="custom-file-label" for="customFileLangBackground">
                                                        @if($settings->background_image != null)
                                                            {{basename($settings->background_image)}}
                                                        @else
                                                            Nenhuma imagem
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <button id="removeBackgroundFile" type="button" class="btn btn-danger mr-auto">Remover</button>
                                                <input name="removeBackgroundFileInput" id="removeBackgroundFileInput" type="hidden" value="false">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <br />
                                    <label for="customRange1">Nível de transparência</label>
                                    <input type="range" name="background_image_transparency" value="{{(!empty($settings->background_image_transparency)?$settings->background_image_transparency:'100')}}" class="custom-range" min="0" max="100" id="transparency_background">
                                <br />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-footer">
                                <button class="btn btn-secondary" type="button">Cancelar</button>
                                <button class="btn btn-success float-right" type="submit">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $('#removeHeaderFile').on('click',function(){
            $('#removeHeaderFileInput').val('true');
            var iframe = document.getElementById('editor-iframe');
            iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&headerImage=false';
            $('#customFileLangHeader').next('.custom-file-label').html('Nenhuma imagem');
        })
        $('#removeBackgroundFile').on('click',function(){
            $('#removeBackgroundFileInput').val('true');
            var iframe = document.getElementById('editor-iframe');
            iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&backgroundImage=false';
            $('#customFileLangBackground').next('.custom-file-label').html('Nenhuma imagem');
        })

        $('#customFileLang').on('change',function(){
            //get the file name
            var fileName = document.getElementById("customFileLang").files[0].name; ;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#customFileLangHeader').on('change',function(){
            //get the file name
            var fileName = document.getElementById("customFileLangHeader").files[0].name; ;
            //replace the "Choose a file" label
            $(this).next('#header_input .custom-file-label').html(fileName);
            $('#removeHeaderFileInput').val('false');
        })

        $('#customFileLangBackground').on('change',function(){
            //get the file name
            var fileName = document.getElementById("customFileLangBackground").files[0].name; ;
            //replace the "Choose a file" label
            $(this).next('#background_input .custom-file-label').html(fileName);
            $('#removeBackgroundFileInput').val('false');
        })

        $( document ).ready(function() {
            $('#logo_style').change(function(){
                var iframe = document.getElementById('editor-iframe');
                iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&logoStyle='+$(this).val();
            });
            $('#logo_input #customFileLang').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $.post( "{{route('admin-layout-cache-logo')}}", {logoImage: e.target.result})
                            .done(function() {
                                var iframe = document.getElementById('editor-iframe');
                                iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&logoImage=true';
                            });

                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#background_input #customFileLangBackground').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $.post( "{{route('admin-layout-cache-background')}}", {backgroundImage: e.target.result})
                            .done(function() {
                                var iframe = document.getElementById('editor-iframe');
                                iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&backgroundImage=true';
                            });

                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#header_input #customFileLangHeader').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $.post( "{{route('admin-layout-cache-header')}}", {headerImage: e.target.result})
                            .done(function() {
                                var iframe = document.getElementById('editor-iframe');
                                iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&headerImage=true';
                                console.log(e.target.result);
                            });

                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });

        $(document).on('change', '#transparency_header_image', function() {
            var iframe = document.getElementById('editor-iframe');
            iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&transparencyHeaderImage='+$(this).val();
        });
        $(document).on('change', '#transparency_background', function() {
            var iframe = document.getElementById('editor-iframe');
            iframe.src = 'http://{{$settings->schema_name}}{{'.'.env('MENU_DOMAIN').'/'}}?editor=1&transparencyBackground='+$(this).val();
        });
        $('input[name="search_bar_background_color"]').val("{{(!empty($settings->search_bar_background_color)?$settings->search_bar_background_color:'f8f9fc')}}");
        $('input[name="search_bar_text_color"]').val("{{(!empty($settings->search_bar_text_color)?$settings->search_bar_text_color:'c7c7c7')}}");
        $('input[name="header_color"]').val("{{(!empty($settings->header_color)?$settings->header_color:'bbbbbb')}}");
        $('input[name="header_text_color"]').val("{{(!empty($settings->header_text_color)?$settings->header_text_color:'ffffff')}}");
        $('input[name="top_color"]').val("{{(!empty($settings->top_color)?$settings->top_color:'848383')}}");
        $('input[name="top_text_color"]').val("{{(!empty($settings->top_text_color)?$settings->top_text_color:'ffffff')}}");
        $('input[name="background_color"]').val("{{(!empty($settings->background_color)?$settings->background_color:'f5f5f5')}}");
        $('input[name="titles_text_color"]').val("{{(!empty($settings->titles_text_color)?$settings->titles_text_color:'010101')}}");
        $('input[name="content_text_color"]').val("{{(!empty($settings->content_text_color)?$settings->content_text_color:'666666')}}");
        $('input[name="prices_text_color"]').val("{{(!empty($settings->prices_text_color)?$settings->prices_text_color:'388000')}}");
        $('input[name="logo_border_color"]').val("{{(!empty($settings->logo_border_color)?$settings->logo_border_color:'848383')}}");
        $('input[name="logo_background_color"]').val("{{(!empty($settings->logo_background_color)?$settings->logo_background_color:'ffffff')}}");
        $('input[name="footer_background_color"]').val("{{(!empty($settings->footer_background_color)?$settings->footer_background_color:'bbbbbb')}}");
        $('input[name="payment_background_color"]').val("{{(!empty($settings->payment_background_color)?$settings->payment_background_color:'ffffff')}}");
        $('input[name="payment_text_color"]').val("{{(!empty($settings->payment_text_color)?$settings->payment_text_color:'000000')}}");
        $('input[name="schedule_background_color"]').val("{{(!empty($settings->schedule_background_color)?$settings->schedule_background_color:'ffffff')}}");
        $('input[name="schedule_text_color"]').val("{{(!empty($settings->schedule_text_color)?$settings->schedule_text_color:'000000')}}");
        const pickrContainerHeaderColor = document.querySelector('#pickr-container-header-color');
        const themesHeaderColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsHeaderColor = [];
        let pickrHeaderColor = null;

        for (const [theme, configHeaderColor] of themesHeaderColor) {
            const buttonHeaderColor = document.createElement('button');
            buttonsHeaderColor.push(buttonHeaderColor);

            buttonHeaderColor.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerHeaderColor.appendChild(el);

                // Delete previous instance
                if (pickrHeaderColor) {
                    pickrHeaderColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrHeaderColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->header_color)?$settings->header_color:"bbbbbb")}}'
                }, configHeaderColor));
            });

        }

        buttonsHeaderColor[0].click();

        pickrHeaderColor.on('change',(color, instance) => {
            this.save();
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="header_color"]').val(val);
            reloadFrame('headerColor', val);
        })

        const pickrContainerHeaderColorText = document.querySelector('#pickr-container-header-color-text');
        const themesHeaderColorText = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsHeaderColorText = [];
        let pickrHeaderColorText = null;

        for (const [theme, configHeaderColorText] of themesHeaderColorText) {
            const buttonHeaderColorText = document.createElement('button');
            buttonsHeaderColorText.push(buttonHeaderColorText);

            buttonHeaderColorText.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerHeaderColorText.appendChild(el);

                // Delete previous instance
                if (pickrHeaderColorText) {
                    pickrHeaderColorText.destroyAndRemove();
                }

                // Create fresh instance
                pickrHeaderColorText = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->header_text_color)?$settings->header_text_color:"ffffff")}}'
                }, configHeaderColorText));
            });

        }

        buttonsHeaderColorText[0].click();

        pickrHeaderColorText.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="header_text_color"]').val(val);
            reloadFrame('headerColorText', val);
        })

        const pickrContainerTopColor = document.querySelector('#pickr-container-top-color');
        const themesTopColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsTopColor = [];
        let pickrTopColor = null;

        for (const [theme, configTopColor] of themesTopColor) {
            const buttonTopColor = document.createElement('button');
            buttonsTopColor.push(buttonTopColor);

            buttonTopColor.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerTopColor.appendChild(el);

                // Delete previous instance
                if (pickrTopColor) {
                    pickrTopColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrTopColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->top_color)?$settings->top_color:"848383")}}'
                }, configTopColor));
            });

        }

        buttonsTopColor[0].click();

        pickrTopColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="top_color"]').val(val);
            reloadFrame('topColor', val);
        })

        const pickrContainerTopColorText = document.querySelector('#pickr-container-top-color-text');
        const themesTopColorText = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsTopColorText = [];
        let pickrTopColorText = null;

        for (const [theme, configTopColorText] of themesTopColorText) {
            const buttonTopColorText = document.createElement('button');
            buttonsTopColorText.push(buttonTopColorText);

            buttonTopColorText.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerTopColorText.appendChild(el);

                // Delete previous instance
                if (pickrTopColorText) {
                    pickrTopColorText.destroyAndRemove();
                }

                // Create fresh instance
                pickrTopColorText = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->top_text_color)?$settings->top_text_color:"ffffff")}}'
                }, configTopColorText));
            });

        }

        buttonsTopColorText[0].click();

        pickrTopColorText.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="top_text_color"]').val(val);
            reloadFrame('topColorText', val);
        })


        const pickrContainerBackgroundColor = document.querySelector('#pickr-container-background-color');
        const themesBackgroundColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsBackgroundColor = [];
        let pickrBackgroundColor = null;

        for (const [theme, configBackgroundColor] of themesBackgroundColor) {
            const buttonBackgroundColor = document.createElement('button');
            buttonsBackgroundColor.push(buttonBackgroundColor);

            buttonBackgroundColor.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerBackgroundColor.appendChild(el);

                // Delete previous instance
                if (pickrBackgroundColor) {
                    pickrBackgroundColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrBackgroundColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->background_color)?$settings->background_color:"f5f5f5")}}'
                }, configBackgroundColor));
            });

        }

        buttonsBackgroundColor[0].click();

        pickrBackgroundColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="background_color"]').val(val);
            reloadFrame('backgroundColor', val);
        })


        const pickrContainerTitleColorText = document.querySelector('#pickr-container-title-color-text');
        const themesTitleColorText = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsTitleColorText = [];
        let pickrTitleColorText = null;

        for (const [theme, configTitleColorText] of themesTitleColorText) {
            const buttonTitleColorText = document.createElement('button');
            buttonsTitleColorText.push(buttonTitleColorText);

            buttonTitleColorText.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerTitleColorText.appendChild(el);

                // Delete previous instance
                if (pickrTitleColorText) {
                    pickrTitleColorText.destroyAndRemove();
                }

                // Create fresh instance
                pickrTitleColorText = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->titles_text_color)?$settings->titles_text_color:"000000")}}'
                }, configTitleColorText));
            });

        }

        buttonsTitleColorText[0].click();

        pickrTitleColorText.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="titles_text_color"]').val(val);
            reloadFrame('titleColorText', val);
        })

        const pickrContainerContentColorText = document.querySelector('#pickr-container-content-color-text');
        const themesContentColorText = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsContentColorText = [];
        let pickrContentColorText = null;

        for (const [theme, configContentColorText] of themesContentColorText) {
            const buttonContentColorText = document.createElement('button');
            buttonsContentColorText.push(buttonContentColorText);

            buttonContentColorText.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerContentColorText.appendChild(el);

                // Delete previous instance
                if (pickrContentColorText) {
                    pickrContentColorText.destroyAndRemove();
                }

                // Create fresh instance
                pickrContentColorText = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->content_text_color)?$settings->content_text_color:"666")}}'
                }, configContentColorText));
            });

        }

        buttonsContentColorText[0].click();

        pickrContentColorText.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="content_text_color"]').val(val);
            reloadFrame('contentColorText', val);
        })


        const pickrContainerPriceColorText = document.querySelector('#pickr-container-price-color-text');
        const themesPriceColorText = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsPriceColorText = [];
        let pickrPriceColorText = null;

        for (const [theme, configPriceColorText] of themesPriceColorText) {
            const buttonPriceColorText = document.createElement('button');
            buttonsPriceColorText.push(buttonPriceColorText);

            buttonPriceColorText.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerPriceColorText.appendChild(el);

                // Delete previous instance
                if (pickrPriceColorText) {
                    pickrPriceColorText.destroyAndRemove();
                }

                // Create fresh instance
                pickrPriceColorText = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->prices_text_color)?$settings->prices_text_color:"008000")}}'
                }, configPriceColorText));
            });

        }

        buttonsPriceColorText[0].click();

        pickrPriceColorText.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="prices_text_color"]').val(val);
            reloadFrame('priceColorText', val);
        })

        const pickrContainerLogoBackgroundColor = document.querySelector('#pickr-container-logo-background-color');
        const themesLogoBackgroundColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsLogoBackgroundColor = [];
        let pickrLogoBackgroundColor = null;

        for (const [theme, configLogoBackgroundColor] of themesLogoBackgroundColor) {
            const buttonLogoBackgroundColor = document.createElement('button');
            buttonsLogoBackgroundColor.push(buttonLogoBackgroundColor);

            buttonLogoBackgroundColor.addEventListener('click', () => {
                const el = document.createElement('p');
                pickrContainerLogoBackgroundColor.appendChild(el);

                // Delete previous instance
                if (pickrLogoBackgroundColor) {
                    pickrLogoBackgroundColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrLogoBackgroundColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->logo_background_color)?$settings->logo_background_color:"ffffff")}}'
                }, configLogoBackgroundColor));
            });

        }

        buttonsLogoBackgroundColor[0].click();

        pickrLogoBackgroundColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="logo_background_color"]').val(val);
            reloadFrame('logoBackgroundColor', val);
        })
//
        const pickrContainerLogoBorderColor = document.querySelector('#pickr-container-logo-border-color');
        const themesLogoBorderColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsLogoBorderColor = [];

        let pickrLogoBorderColor = null;

        for (const [theme, configLogoBorderColor] of themesLogoBorderColor) {
            const buttonLogoBorderColor = document.createElement('button');
            buttonsLogoBorderColor.push(buttonLogoBorderColor);

            buttonLogoBorderColor.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainerLogoBorderColor.appendChild(el);

                // Delete previous instance
                if (pickrLogoBorderColor) {
                    pickrLogoBorderColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrLogoBorderColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->logo_border_color)?$settings->logo_border_color:"848383")}}'
                }, configLogoBorderColor));
            });

        }

        buttonsLogoBorderColor[0].click();

        pickrLogoBorderColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="logo_border_color"]').val(val);
            reloadFrame('logoBorderColor', val);
        })

        //

        const pickrContainerbackgroundColorSearchBar = document.querySelector('#pickr-container-search-bar-background-color');
        const themesbackgroundColorSearchBar = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsbackgroundColorSearchBar = [];

        let pickrbackgroundColorSearchBar = null;

        for (const [theme, configbackgroundColorSearchBar] of themesbackgroundColorSearchBar) {
            const buttonbackgroundColorSearchBar = document.createElement('button');
            buttonsbackgroundColorSearchBar.push(buttonbackgroundColorSearchBar);

            buttonbackgroundColorSearchBar.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainerbackgroundColorSearchBar.appendChild(el);

                // Delete previous instance
                if (pickrbackgroundColorSearchBar) {
                    pickrbackgroundColorSearchBar.destroyAndRemove();
                }

                // Create fresh instance
                pickrbackgroundColorSearchBar = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->search_bar_background_color)?$settings->search_bar_background_color:"FFFFFF")}}'
                }, configbackgroundColorSearchBar));
            });

        }

        buttonsbackgroundColorSearchBar[0].click();

        pickrbackgroundColorSearchBar.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="search_bar_background_color"]').val(val);
            reloadFrame('backgroundColorSearchBar', val);
        })
////
        const pickrContainertextColorSearchBar = document.querySelector('#pickr-container-search-bar-text-color');
        const themestextColorSearchBar = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonstextColorSearchBar = [];

        let pickrtextColorSearchBar = null;

        for (const [theme, configtextColorSearchBar] of themestextColorSearchBar) {
            const buttontextColorSearchBar = document.createElement('button');
            buttonstextColorSearchBar.push(buttontextColorSearchBar);

            buttontextColorSearchBar.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainertextColorSearchBar.appendChild(el);

                // Delete previous instance
                if (pickrtextColorSearchBar) {
                    pickrtextColorSearchBar.destroyAndRemove();
                }

                // Create fresh instance
                pickrtextColorSearchBar = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->search_bar_text_color)?$settings->search_bar_text_color:"c7c7c7")}}'
                }, configtextColorSearchBar));
            });

        }

        buttonstextColorSearchBar[0].click();

        pickrtextColorSearchBar.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="search_bar_text_color"]').val(val);
            reloadFrame('textColorSearchBar', val);
        })


        //
        const pickrContainerfooterBackgroundColor = document.querySelector('#pickr-container-footer-background-color');
        const themesfooterBackgroundColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonsfooterBackgroundColor = [];

        let pickrfooterBackgroundColor = null;

        for (const [theme, configfooterBackgroundColor] of themesfooterBackgroundColor) {
            const buttonfooterBackgroundColor = document.createElement('button');
            buttonsfooterBackgroundColor.push(buttonfooterBackgroundColor);

            buttonfooterBackgroundColor.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainerfooterBackgroundColor.appendChild(el);

                // Delete previous instance
                if (pickrfooterBackgroundColor) {
                    pickrfooterBackgroundColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrfooterBackgroundColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->footer_background_color)?$settings->footer_background_color:"bbbbbb")}}'
                }, configfooterBackgroundColor));
            });

        }

        buttonsfooterBackgroundColor[0].click();

        pickrfooterBackgroundColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="footer_background_color"]').val(val);
            reloadFrame('footerBackgroundColor', val);
        })

        //

        const pickrContainerpaymentBackgroundColor = document.querySelector('#pickr-container-payment-background-color');
        const themespaymentBackgroundColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonspaymentBackgroundColor = [];

        let pickrpaymentBackgroundColor = null;

        for (const [theme, configpaymentBackgroundColor] of themespaymentBackgroundColor) {
            const buttonpaymentBackgroundColor = document.createElement('button');
            buttonspaymentBackgroundColor.push(buttonpaymentBackgroundColor);

            buttonpaymentBackgroundColor.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainerpaymentBackgroundColor.appendChild(el);

                // Delete previous instance
                if (pickrpaymentBackgroundColor) {
                    pickrpaymentBackgroundColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrpaymentBackgroundColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->payment_background_color)?$settings->payment_background_color:"ffffff")}}'
                }, configpaymentBackgroundColor));
            });

        }

        buttonspaymentBackgroundColor[0].click();

        pickrpaymentBackgroundColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="payment_background_color"]').val(val);
            reloadFrame('paymentBackgroundColor', val);
        })
//

        const pickrContainerpaymentTextColor = document.querySelector('#pickr-container-payment-text-color');
        const themespaymentTextColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonspaymentTextColor = [];

        let pickrpaymentTextColor = null;

        for (const [theme, configpaymentTextColor] of themespaymentTextColor) {
            const buttonpaymentTextColor = document.createElement('button');
            buttonspaymentTextColor.push(buttonpaymentTextColor);

            buttonpaymentTextColor.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainerpaymentTextColor.appendChild(el);

                // Delete previous instance
                if (pickrpaymentTextColor) {
                    pickrpaymentTextColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrpaymentTextColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->payment_text_color)?$settings->payment_text_color:"000000")}}'
                }, configpaymentTextColor));
            });

        }

        buttonspaymentTextColor[0].click();

        pickrpaymentTextColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="payment_text_color"]').val(val);
            reloadFrame('paymentTextColor', val);
        })

        //


        const pickrContainersheduleBackgroundColor = document.querySelector('#pickr-container-schedule-background-color');
        const themessheduleBackgroundColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonssheduleBackgroundColor = [];

        let pickrsheduleBackgroundColor = null;

        for (const [theme, configsheduleBackgroundColor] of themessheduleBackgroundColor) {
            const buttonsheduleBackgroundColor = document.createElement('button');
            buttonssheduleBackgroundColor.push(buttonsheduleBackgroundColor);

            buttonsheduleBackgroundColor.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainersheduleBackgroundColor.appendChild(el);

                // Delete previous instance
                if (pickrsheduleBackgroundColor) {
                    pickrsheduleBackgroundColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrsheduleBackgroundColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->schedule_background_color)?$settings->schedule_background_color:"ffffff")}}'
                }, configsheduleBackgroundColor));
            });

        }

        buttonssheduleBackgroundColor[0].click();

        pickrsheduleBackgroundColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="schedule_background_color"]').val(val);
            reloadFrame('sheduleBackgroundColor', val);
        })

        //

        const pickrContainersheduleTextColor = document.querySelector('#pickr-container-schedule-text-color');
        const themessheduleTextColor = [
            [
                'nano',
                {
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)',
                        'rgba(0, 188, 212, 0.7)',
                        'rgba(0, 150, 136, 0.75)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(139, 195, 74, 0.85)',
                        'rgba(205, 220, 57, 0.9)',
                        'rgba(255, 235, 59, 0.95)',
                        'rgba(255, 193, 7, 1)'
                    ],

                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        id: 'pickr-container-logo-border-color',

                        interaction: {
                            input: true,
                            clear: true,
                            save: true,
                            cancel: true
                        }
                    },
                    strings: {
                        save: 'Salvar',  // Default for save button
                        clear: 'Limpar', // Default for clear button
                        cancel: 'Cancelar' // Default for cancel button
                    }
                }
            ],
        ];

        const buttonssheduleTextColor = [];

        let pickrsheduleTextColor = null;

        for (const [theme, configsheduleTextColor] of themessheduleTextColor) {
            const buttonsheduleTextColor = document.createElement('button');
            buttonssheduleTextColor.push(buttonsheduleTextColor);

            buttonsheduleTextColor.addEventListener('click', () => {

                const el = document.createElement('p');
                pickrContainersheduleTextColor.appendChild(el);

                // Delete previous instance
                if (pickrsheduleTextColor) {
                    pickrsheduleTextColor.destroyAndRemove();
                }

                // Create fresh instance
                pickrsheduleTextColor = new Pickr(Object.assign({
                    el, theme,
                    default: '#{{(!empty($settings->schedule_text_color)?$settings->schedule_text_color:"000000")}}'
                }, configsheduleTextColor));
            });

        }

        buttonssheduleTextColor[0].click();

        pickrsheduleTextColor.on('save',(color) => {
            var val = color.toHEXA().toString();
            val = val.replace('#', '');
            $('input[name="schedule_text_color"]').val(val);
            reloadFrame('sheduleTextColor', val);
        })
        function reloadFrame(param, val){
            var iframe = document.getElementById('editor-iframe');
            var query_string = encodeURI('?editor=1&'+param+'='+val);
            iframe.src = 'http://{{$settings->schema_name}}{{(config('tenant.mode') != 'standalone')?'.':''}}{{env('MENU_DOMAIN').'/'}}'+query_string;
        }
    </script>
@stop
