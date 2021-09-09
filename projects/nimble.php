<div class="media">

<div class="media-left">
<img class="media-object" src="projects/nimble.png" width="128" height="192"/>
</div>

<div class="media-body">
<h4 class="media-heading">VM memory demand projection</h4>
<small>
<a href="projects/nimble.pdf"><span class="fa fa-file-pdf-o"></span></a>
</small></br/>
Virtualization technology has been widely adopted in IaaS cloud computing environment. Through virtualization, the processor, network, and storage resources can be transparently shared at fine granularity, but the memory still requires explicit coarse-grained provisioning in most cases. Yet it is not always clear how much memory should be provisioned for a virtual machine (VM). It depends on the application workload and characteristics of the underlying platform. We present NIMBLE, a novel system to project the memory demand of virtual machines in IaaS cloud environment. NIMBLE monitors the page swapping activities of a VM at runtime and project its memory demand by indicating the expected execution time of the application workload for each targeted guest physical memory size. This allows more intuitive and cost-effective memory resource provisioning for VMs. The experiment results indicate that NIMBLE can effectively project memory demand for selected benchmark workloads on both Linux and Windows guest VMs. The results also indicate that NIMBLE incurs negligible performance overhead.
</div>

</div>
