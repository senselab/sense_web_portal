<div class="media">

<div class="media-left">
<img class="media-object" src="projects/2013_vmteleport.png" width="128" height="192"/>
</div>

<div class="media-body">
<h4 class="media-heading">VM WAN Migration</h4>
<small>
<a href="projects/2013_vmteleport.pdf"><span class="fa fa-file-pdf-o"></span></a>
</small></br/>
Conventional virtual machine (VM) migration focuses on transferring a VM’s memory and CPU states across host machines. The VM’s disk image has to remain accessible to both the source and destination host machines through shared storage during the migration. As a result, conventional virtual machine migration is limited to host machines on the same local area network (LAN) since sharing storage across wide-area network (WAN) is inefficient. As datacenters are being constructed around the globe, we envision the need for VM migration across datacenter boundaries. We thus propose a system aiming to achieve efficient VM migration over wide area network. The system exploits similarity in the storage data of neighboring VMs by first indexing the VM storage images and then using the index to locate storage data blocks from neighboring VMs, as opposed to pulling all data from the remote source VM across WAN. The experiment result shows that the system can achieve an average 66% reduction in the amount of data transmission and an average 59% reduction in the total migration time.
</div>

</div>
