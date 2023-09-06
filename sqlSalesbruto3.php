<?php
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
			--where so.BuyerID='$idBuyer' --and so.SODate between '$tgl1' and '$tgl2'
			where so.SalesPersonCode='$kodebuyer' and soda.GrossWeight > '1000' and so.SODate between '$tgl1' and '$tgl2'
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
				x.SODID";
}else if ($Rbruto=='9'){
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
			where so.SalesPersonCode='$kodebuyer' and soda.GrossWeight between '1' and '24' and so.SODate between '$tgl1' and '$tgl2'
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
				x.SODID";
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
			where so.SalesPersonCode='$kodebuyer' and soda.GrossWeight > '1' and so.SODate between '$tgl1' and '$tgl2'
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
				x.SODID";
				
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
			--where so.BuyerID='$idBuyer' --and so.SODate between '$tgl1' and '$tgl2'
			where so.SalesPersonCode='$kodebuyer' and soda.GrossWeight between '$r1' and '$r2' and so.SODate between '$tgl1' and '$tgl2'
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
				x.SODID";
}
?>