<?php

namespace model;

class MapHazard extends SplEnum {
	const __default = self::None;
	
	const None = " ";
	const Spike = H;
	const Goo = G;
	const Pit = P;
}
