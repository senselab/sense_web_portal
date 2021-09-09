<div class="media">

<div class="media-left">
<img class="media-object" src="projects/2014_mom.png" width="128" height="192"/>
</div>

<div class="media-body">
<h4 class="media-heading">Application Dependency Tracing for Message Oriented Middleware</h4>
<small>
<a href="projects/2014_mom.pdf"><span class="fa fa-file-pdf-o"></span></a>
</small></br/>
Software defined infrastructure greatly reduces the deployment cost of distributed applications. Many distributed applications employ message oriented middleware (MOM) for the integration of heterogeneous components and to achieve scalability and fault tolerance. The structure of a distributed application can be very complex. In addition, the asynchronous message delivery model of MOM further complicates the runtime behavior of a distributed application. To diagnose a faulty distributed application, one often needs to determine the dependences of its messages, and by extension, the dependences of its components. We propose Message Tracer to identify the message dependencies of a MOM-based distributed application. Message Tracer sniffs the network traffic of MOM and uses knowledge of message broker protocols to establish the dependencies. Message Tracer makes no assumption on the application threading model and incurs negligible performance overhead. Message Tracer correctly identified 95% of the dependencies for the common use cases and 75% of the dependencies when the system was under extreme stress.
</div>

</div>
