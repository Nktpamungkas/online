<?php
$sql0="select distinct(z.NoKK),z.* from 
(
select
			convert(char(10),mp.InputDate,120) as InputDate,mp.PersonID,mp.OrderNumber, x.TglSO,x.DocumentNo,x.LotNo as Lotnya,x.PCID,x.PCBID,x.SODID,cust.PartnerName as CustomerName,buy.PartnerName as BuyerName,x.NoKK,x.Bruto,
			x.RequiredDate,x.SODate,x.TglCelup, x.MachineID,x.Capacity, x.ProductID,pm.Description as ProductDesc, pm.ColorNo, pm.Color,dep.DepartmentCode, x.SalesPersonName,
			CONVERT(VARCHAR(80),soda2.Note)as Catatan, pm.HangerNo, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, soda.ID as SODAID,
				soda.RefNo as DetailRefNo,so.SalesPersonName,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, convert(char(10),pcb.ScheduledDate,120) as TglCelup, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.MachineID,pcb.Capacity,RequiredDate= CONVERT(char(10), RequiredDate, 3),pcb.PCID,
				pcb.LotNo,SODate= CONVERT(char(10), SODate, 3)
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID				
			where sod.RequiredDate between '$reqdate1' and '$reqdate2'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,so.SalesPersonName,pcb.MachineID,pcb.Capacity,sod.RequiredDate,pcb.PCID,soda.ID,LotNo
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID left join
				PPCMasterPlan mp on mp.ProductID = x.ProductID and mp.OrderNumber=x.DocumentNo left join
				SODetailsAdditional soda2 on x.SODAID=soda2.ID
			where (soda2.Note not like 'Ambil%') and (soda2.Note not like 'AKJ%') and (soda2.Note not like 'cancel%')
			) z left join 
			PCCardPosition pccp on pccp.PCBID=z.PCBID
			where pccp.DepartmentID<>'27'
			order by z.RequiredDate,z.SODID,z.PCBID";
?>