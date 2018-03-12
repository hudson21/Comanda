<header id="menuDes" class="menuDesplegable">
    <div style="z-index:2000"  class="menu_bar">
      <a  class="bt-menu text-uppercase backColor"><span class="icon-home"></span>Categorías</a>
    </div>
 
    <nav >
      <ul style="margin-top:0px; margin-bottom:0px" >

         <?php

            $item=null;
            $valor=null;

                $categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);

                forEach($categorias as $key => $value){

                   echo ' <li class="submenu ">
                            <a style="font-weight:bold;" ><span class="icon-checkmark2 "></span>'.$value["categoria"].'<span class="caret icon-arrow-down6"></span></a>';

                        $item = "id_categoria";
                        $valor = $value["id"];
                         //De esta manera se va a llevar el id de la subcategoría que se esté mostrando
                        $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                        echo'<ul class="children">';

                        foreach($subcategorias as $key => $value1){
                          echo'<li ><a style="font-weight:bold;" href="'.$url.$value1["ruta"].'">'.$value1["subcategoria"].'<span ></span></a></li>';        
                        }

                        echo'</ul></li>';
          
              }
                         

          ?>
        
      </ul>
    </nav>
  </header>