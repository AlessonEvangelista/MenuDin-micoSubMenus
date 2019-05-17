@php
    function menuSubItens($arrays, $name)
    {
        foreach($arrays as $key => $array) {

            /**
            * Verifica se array contém array de sub_itens
            */
            if( isset($array["sub_itens"]) ) {

                /**
                * Verifica se o array sub_itens contém ítens no array
                */
                if($array['sub_itens'] != [])
                {
                    /**
                    * Monta lista com ítens
                    */
                    echo "<li class='list-group-item menu-nivel menu-nivel-".$array['nivel']."' onclick='SelectedField(\"".$name."\",".$array['id'].")' onmouseleave='rowbackcolor(\"list-group-changed-\",".$array['id'].")' onmouseenter='changecolor(\"list-group-changed-\",".$array['id'].")' id='list-group-changed-".$array['id']."'>
                                <span class='icon s7-angle-right-circle' ></span> ". $array['descricao'] ." </li>";
                    echo '<ul class="list-group list-group-flush" >';

                        /**
                        *  Chama novamente a função para percorrer array e envia o próximo ítem do array.
                        */
                        menuSubItens($array['sub_itens'], $name);
                    echo '</ul>';
                }
                else
                {
                    /**
                    * Se não existe ítens inferiores apenas monta a lista do array atual
                    */
                    echo "<li class='list-group-item menu-nivel menu-nivel-".$array['nivel']."' onclick='SelectedField(\"".$name."\",".$array['id'].")' onmouseleave='rowbackcolor(\"list-group-changed-\",".$array['id'].")' onmouseenter='changecolor(\"list-group-changed-\",".$array['id'].")' id='list-group-changed-".$array['id']."'>
                            <span class='icon s7-angle-right-circle' ></span> ". $array['descricao'] ." </li>";
                }
            }
        }
    }
@endphp

<div class="row p-3 form-group d-flex justify-content">
    <div class="col-12 col-sm-5 col-lg-3">
        <div class="row">
            <div class="col-4 col-sm-3 col-lg-4">
                <label for="colecaoShow">File</label>
            </div>
            <div class="col-8 col-sm-9 col-lg-8">
                <a class="btn btn-rounded btn-space btn-secondary" data-toggle="modal" data-target="#md-file">
                    <i class="icon icon-left s7-config"></i> Selecionar
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-7 col-lg-9">
        <input type="hidden" id="file" name="fkfile" value="{{ $produto ? $produto['fkfile'] : '' }}">
        <input class="form-control" type="text" id="fileShow" disabled="disabled" placeholder="Selecione a Coleção no botão ao lado" value="{{ $collectionShow ? $collectionShow : '' }}" >
    </div>
</div>




<div class="modal fade" id="md-file" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="s7-close"></span></button>
            </div>
            <div class="modal-body">
              <div class="card" style="border: 1px solid #ebebee; border-radius: 3px;">
                  <ul class="list-group list-group-flush">
                      @foreach($collection as $arrayMenus)
                          <li class="list-group-item" onclick="SelectedField('file', {{ $arrayMenus['id'] }} )" onmouseleave="rowbackcolor('list-group-changed-', {{ $arrayMenus['id'] }} )" onmouseenter="changecolor('list-group-changed-', {{ $arrayMenus['id'] }} )" id="list-group-changed-{{ $arrayMenus['id'] }}">
                              <span class="icon s7-angle-right-circle" ></span> {{ $arrayMenus['descricao'] }}
                          </li>
                          @if($arrayMenus['sub_itens'])
                              <ul class="list-group list-group-flush">
                                  @php
                                      menuSubItens($arrayMenus['sub_itens'], 'file');
                                  @endphp
                              </ul>
                          @endif
                      @endforeach
                  </ul>
              </div>
            </div>
          </div>
      </div>
  </div>



{{--
  Chama Collection Js, para aplicar efeitos do elemento DOM
  E consumir API, passando itém selecionado pelo cliente.

   Retornando string de retorno da API, para preencher imput.
--}}
<script src="js/menuCollection.js">
