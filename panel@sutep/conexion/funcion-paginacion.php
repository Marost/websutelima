<?php

function paginar($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}

function paginar2($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$btn="Buscar";
	$busq=$_REQUEST["busqueda"];
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior&busqueda=$busq&btnbuscar=$btn\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i&busqueda=$busq&btnbuscar=$btn\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i&busqueda=$busq&btnbuscar=$btn\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior&busqueda=$busq&btnbuscar=$btn\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}

function paginarComentario($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$tema=$_REQUEST["id"];
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior&id=$tema\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i&id=$tema\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i&id=$tema\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior&id=$tema\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}

function paginarGaleria($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$tema=$_REQUEST["id"];
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior&id=$tema\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i&id=$tema\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i&id=$tema\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior&id=$tema\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}

function paginarBusqueda($actual, $total, $por_pagina, $enlace, $maxpags=0, $buscar)
{
	$busq=$buscar;
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior&busqueda=$busq\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i&busqueda=$busq\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i&busqueda=$busq\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior&busqueda=$busq\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}

function paginarComentarioColumnista($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$tema=$_REQUEST["id"];
	$columnista=$_REQUEST["columnista"];
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior&id=$tema&columnista=$columnista\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i&id=$tema&columnista=$columnista\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i&id=$tema&columnista=$columnista\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior&id=$tema&columnista=$columnista\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}

function paginarPortada($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
		$texto = "<a href=\"$enlace$anterior\">&lt;&lt; Anterior -- </a> ";
	if ($actual<$total_paginas)
		$texto .= "<a href=\"$enlace$posterior\"> -- Siguiente &gt;&gt;</a>";
	return $texto;
}

function paginarNoticias($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior\">Anterior</a> ";
	else
	$texto = "<b>&lt;&lt;</b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior\">Siguiente</a>";
	else
	$texto .= "<b>&gt;&gt;</b>";
	return $texto;
}
?>