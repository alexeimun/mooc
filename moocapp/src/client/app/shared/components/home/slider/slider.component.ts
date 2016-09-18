import {Component, OnInit} from '@angular/core';

declare var jQuery: any;

/**
 * This class represents the lazy loaded sliderComponent.
 */
@Component({
  moduleId : module.id,
  selector : 'app-slider',
  templateUrl : 'slider.component.html',
  styleUrls : ['slider.component.css']
})
export class SliderComponent implements OnInit {

  ngOnInit(): any
  {
    jQuery("#slider2").responsiveSlides({
      auto : true,
      speed : 300
    });
  }

  constructor()
  {
  }
}
