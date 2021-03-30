#!/usr/bin/php
<?php
$html_title="OWINFS - Español";
include 'include/head_etc.php'
?>
    <div id="main">
<?php
$language="es";
include 'include/sidebar_aboutpage.php';
include 'include/navbar.php';
?>
      <div id="content" class="singlecolumn">
        <h1>Recursos actuales en español</h1>
<?php
include 'include/article_links.php';
article_links("data/articles", "es");
?>
        <h1>Cobertura de medios en español</h1>
<ol>
  <li><a href="https://www.pagina12.com.ar/79504-las-on-gs-en-la-lista-negra-de-macri">Las ONGs, en la lista negra de Macri</a>, <i>Pagina 12</i>
  </li><li><a href="http://www.perfil.com/politica/argentina-prohibio-a-64-activistas-participar-de-la-reunion-de-la-omc.phtml">Denuncian que el Gobierno prohibió el ingreso de 64 activistas a la OMC</a>, <i>Perfil</i>
  </li><li><a href="http://www.lavanguardia.com/politica/20171201/433319309619/presentan-en-buenos-aires-programa-de-protestas-contra-la-reunion-de-la-omc.html">Presentan en Buenos Aires programa de protestas contra la reunión de la OMC</a>, <i>EFE</i>
  </li><li><a href="https://www.cronista.com/economiapolitica/El-Gobierno-reconoce-que-prohibio-la-acreditacion-de-ONGs-a-la-OMC-20171201-0086.html">El Gobierno reconoce que prohibió la acreditación de ONGs a la OMC</a>, <i>El Cronista</i>
  </li><li><a href="http://www.ambito.com/905112-activistas-denuncian-que-se-les-impide-el-ingreso-al-pais-para-cumbre-de-la-omc">Activistas denuncian que se les impide el ingreso al país para cumbre de la OMC</a>, <i>Ambito Financiero</i>, which is Argentina's leading business newspaper
  </li><li><a href="http://www.elnuevoherald.com/noticias/finanzas/article187378703.html">Activistas dicen que Argentina niega entrada a cumbre OMC</a>, <i>El Nuevo Herald</i>
  </li><li><a href="https://www.alainet.org/es/articulo/189591">Revocación de inscripciones ciudadanas en la OMC levanta protestas frente al Gobierno de Macri</a>,
<i>America Latina en movimiento online</i>
  </li><li><a href="https://notasperiodismopopular.com.ar/2017/12/01/omc-lanzan-cumbre-pueblos-denuncian-papelon-internacional-macri/">OMC: lanzan Cumbre de los Pueblos y denuncian “papelón internacional” de Macri</a>, <i>Notas</i>
  </li><li><a href="https://notasperiodismopopular.com.ar/2017/12/01/escandalo-desacreditaciones-omc-culpa-gobierno-macri/">Escándalo con desacreditaciones: la OMC le echa la culpa a Macri</a>, <i>Notas</i>
  </li><li><a href="https://www.clarin.com/politica/cumbre-omc-preocupacion-protestas-europa-gobierno-nego-acceso-ongs_0_S1LrxZX-f.html">Cumbre OMC: preocupación y protestas desde Europa porque el Gobierno negó el acceso a ONGs</a>, <i>Clarin</i>, which is one of the main newspapers in Argentina; it is generally supportive of the government of Macri.
  </li><li><a href="http://www.eldisenso.com/politica/gobierno-macri-deporta-periodista-inglesa-critica-gestion-haber-entregado-informacion-argentinos-big-data">El gobierno de Macri deporta a periodista inglesa crítica de su gestión por haber entregado información de argentinos para Big Data</a>, <i>El Disenso</i>
</li></ol>
      </div> <!-- /#content -->
    </div> <!-- /#main -->
<?php
include 'include/foot_etc.php'
?>
