<?php
if ($actual=='2'){
	$jod="and jo.DocumentNo like '%R%'";
}else if ($actual=='3'){
	$jod="and jo.DocumentNo like '%G%'";
}else if ($actual=='1'){
	$jod="and (jo.DocumentNo not like '%G%' and jo.DocumentNo not like '%R%' )";
}else{
	$jod="";
}


if ($Rbruto=='1'){

$sql0="select
			x.TglSO,x.DocumentNo,x.SODID,cust.PartnerName as CustomerName,buy.PartnerName as BuyerName,x.Bruto,
			x.SODate,x.ProductID,pm.Description as ProductDesc, pm.ColorNo, pm.Color, x.SalesPersonName,
			pm.HangerNo
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, soda.ID as SODAID,
				soda.RefNo as DetailRefNo,so.SalesPersonName,so.SalesPersonCode,
				soda.GrossWeight as Bruto,so.SODate				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID 			
			where soda.GrossWeight > '1000' $jod
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,
					soda.GrossWeight,
					so.SalesPersonName,so.SalesPersonCode,sod.RequiredDate,soda.ID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join							
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID
			order by
				x.SalesPersonName,x.SODID";
}else if (($Rbruto=='9')){
$sql0="select
			x.TglSO,x.DocumentNo,x.SODID,cust.PartnerName as CustomerName,buy.PartnerName as BuyerName,x.Bruto,
			x.SODate,x.ProductID,pm.Description as ProductDesc, pm.ColorNo, pm.Color, x.SalesPersonName,
			pm.HangerNo
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, soda.ID as SODAID,
				soda.RefNo as DetailRefNo,so.SalesPersonName,so.SalesPersonCode,
				soda.GrossWeight as Bruto,so.SODate				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID 			
			where soda.GrossWeight between '1' and '24' $jod
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,
					soda.GrossWeight,
					so.SalesPersonName,so.SalesPersonCode,sod.RequiredDate,soda.ID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join							
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID
			order by
				x.SalesPersonName,x.SODID";
}else if ($Rbruto=='all'){
$sql0="select
			x.TglSO,x.DocumentNo,x.SODID,cust.PartnerName as CustomerName,buy.PartnerName as BuyerName,x.Bruto,
			x.SODate,x.ProductID,pm.Description as ProductDesc, pm.ColorNo, pm.Color, x.SalesPersonName,
			pm.HangerNo
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, soda.ID as SODAID,
				soda.RefNo as DetailRefNo,so.SalesPersonName,so.SalesPersonCode,
				soda.GrossWeight as Bruto,so.SODate				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID 
			--where so.BuyerID='$idBuyer' --and so.SODate between '$tgl1' and '$tgl2'
			where soda.GrossWeight > '1' $jod
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,
					soda.GrossWeight,
					so.SalesPersonName,so.SalesPersonCode,sod.RequiredDate,soda.ID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join							
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID
			order by
				x.SalesPersonName,x.SODID";
				
}else{
$sql0="select
			x.TglSO,x.DocumentNo,x.SODID,cust.PartnerName as CustomerName,buy.PartnerName as BuyerName,x.Bruto,
			x.SODate,x.ProductID,pm.Description as ProductDesc, pm.ColorNo, pm.Color, x.SalesPersonName,
			pm.HangerNo
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, soda.ID as SODAID,
				soda.RefNo as DetailRefNo,so.SalesPersonName,so.SalesPersonCode,
				soda.GrossWeight as Bruto,so.SODate				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID 			
			where soda.GrossWeight between '$r1' and '$r2' $jod
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,
					soda.GrossWeight,
					so.SalesPersonName,so.SalesPersonCode,sod.RequiredDate,soda.ID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join							
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID
			order by
				x.SalesPersonName,x.SODID";
}
?>