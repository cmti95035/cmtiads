//
//  ViewController.m
//  Banner_InterfaceBuilder
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController

@synthesize bannerView;

- (NSString *)publisherIdForAdSdkBannerView:(AdSdkBannerView *)banner {
	return @"ENTER_PUBLISHER_ID_HERE";
}

- (void)viewDidLoad {
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.

	self.bannerView.requestURL = @"ENTER_REQUEST_URL_HERE";
	self.bannerView.delegate = self;
}

- (void)viewDidUnload {
	[self setBannerView:nil];
    [super viewDidUnload];
    // Release any retained subviews of the main view.
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation {
	if ([[UIDevice currentDevice] userInterfaceIdiom] == UIUserInterfaceIdiomPhone) {
	    return (interfaceOrientation != UIInterfaceOrientationPortraitUpsideDown);
	} else {
	    return YES;
	}
}

@end
