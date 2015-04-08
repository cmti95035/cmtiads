//
//  ViewController.m
//

#import "ViewController.h"

@implementation ViewController

@synthesize videoInterstitialViewController;

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad {
    
    [super viewDidLoad];
	
	// Create, add Interstitial/Video Ad View Controller and add view to view hierarchy
    self.videoInterstitialViewController = [[AdSdkVideoInterstitialViewController alloc] init];
    
    // Assign delegate
    self.videoInterstitialViewController.delegate = self;
    
    // Defaults to NO. Set to YES to get locationAware Adverts
    self.videoInterstitialViewController.locationAwareAdverts = YES;
    
    // Add view. Note when it is created is transparent, with alpha = 0.0 and hidden
    // Only when an ad is being presented it become visible
    [self.view addSubview:self.videoInterstitialViewController.view];
}

- (void)viewDidUnload {
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated {
    [super viewWillAppear:animated];
}

- (void)viewDidAppear:(BOOL)animated {
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated {
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated {
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation {
    return YES;
}


- (IBAction)requestInterstitialAdvert:(id)sender {
    
    if(self.videoInterstitialViewController) {
        self.videoInterstitialViewController.requestURL = @"ENTER_REQUEST_URL_HERE";
		
        [self.videoInterstitialViewController requestAd];
    }
}

#pragma mark AdSdk Interstitial Delegate Methods

- (NSString *)publisherIdForAdSdkVideoInterstitialView:(AdSdkVideoInterstitialViewController *)videoInterstitial {
    return @"ENTER_PUBLISHER_ID_HERE";
}

- (void)adsdkVideoInterstitialViewDidLoadAdSdkAd:(AdSdkVideoInterstitialViewController *)videoInterstitial advertTypeLoaded:(AdSdkAdType)advertType {
	
    NSLog(@"AdSdk Interstitial: did load ad");
    
    // Means an advert has been retrieved and configured.
    // Display the ad using the presentAd method and ensure you pass back the advertType
    
    [videoInterstitial presentAd:advertType];
}

- (void)adsdkVideoInterstitialView:(AdSdkVideoInterstitialViewController *)banner didFailToReceiveAdWithError:(NSError *)error {
	NSLog(@"AdSdk Interstitial: did fail to load ad: %@", [error localizedDescription]);
}

@end