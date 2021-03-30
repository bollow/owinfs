    <div id="sidebar">
      <div id="sidebar-inner">
<?php
global $language;
if ($language=="es") {
?>
        <h2 class="title">Acerca de OWINFS</h2>
        <div class="content">
        <p>‘Nuestro Mundo No Está en Venta’ (OWINFS) es una red mundial de organizaciones, activistas y movimientos sociales abocados a combatir los acuerdos de comercio e inversiones que promueven la globalización orientada por las transnacionales y benefician a las empresas más poderosas del mundo a costa de los pueblos y el medio ambiente.</p>
	<p><a href="declaracion-unidad-politica">Declaración de unidad política</a></p>
<?php
  } elseif ($language=="fr") {
?>
        <h2 class="title">À propos de OWINFS</h2>
        <div class="content">
        <p>Notre monde n'est pas à vendre (OWINFS) est un réseau mondial d'organismes, d'activistes et de mouvements sociaux qui s'opposent aux ententes commerciales et aux accords d'investissement qui favorisent les intérêts des sociétés les plus puissantes du monde au détriment des personnes et de l'environnement.</p>
	<p><a href="declaration-d-unite">Déclaration d’unité</a></p>
<?php
  } elseif ($language=="it") {
?>
        <h2 class="title">Chi siamo</h2>
        <div class="content">
        <p>Our World Is Not For Sale (OWINFS) è una rete globale di organizzazioni, attivisti e movimenti sociali impegnati a sfidare gli accordi commerciali e sugli investimenti che favoriscono gli interessi delle più potenti imprese multinazionali, a danno delle popolazioni e dell’ambiente.</p>
	<p><a href="documento-di-unita">Documento di Unità</a></p>
<?php
  } else {
?>
        <h2 class="title">About us</h2>
        <div class="content">
        <p>The “Our World is not for Sale” (OWINFS) network is a loose grouping of organizations,
        activists and social movements worldwide fighting the current model of corporate
        globalization embodied in global trading system. OWINFS is committed to a sustainable,
        socially just, democratic and accountable multilateral trading system.</p>
<?php
  }
?>
          <ul>
	    <li><a href="<?php global $prepend_path; echo $prepend_path; ?>o/en/about">About us</a>
<?php
global $this_aboutpage;
$inputfile="data/aboutpages";
$in=fopen($inputfile, "r") or die("Unable to open file '$inputfile'!");
while(!feof($in)) {
  $line=fgets($in);
  $sep=strpos($line, " ");
  if ($sep===FALSE) {
    break;
  }
  $link_target=substr($line, 0, $sep);
  $aboutpage=substr($line, $sep+1, -1);
  if ($aboutpage==$this_aboutpage) {
    echo "            <li><a href='$prepend_path$link_target' class='active'>$aboutpage</a></li>\n";
  } else {
    echo "            <li><a href='$prepend_path$link_target'>$aboutpage</a></li>\n";
  }
}
?>
          </ul>
        </div> <!-- /content -->
        <img src="<?php echo $prepend_path; ?>logo_owinfs_red.png" alt="Our World Is Not For Sale logo"
             width="230" height="225">
      </div> <!-- /#sidebar-inner -->
    </div> <!-- /#sidebar -->
