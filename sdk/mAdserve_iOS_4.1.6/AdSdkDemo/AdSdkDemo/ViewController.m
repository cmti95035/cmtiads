//
//  ViewController.m
//

#import "ViewController.h"

@implementation ViewController

@synthesize videoInterstitialViewController;
@synthesize bannerView;

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

#pragma mark AdSdk Banner Handling

// Methods used to show how you might slide a banner view in and out

-(BOOL)isBannerViewInHiearchy {
    
    for (UIView *oneView in self.view.subviews)
    {
        if(oneView == self.bannerView) {
            return YES;
        }
    }
    
    return NO;
}

- (void)slideOutDidStop:(NSString *)animationID finished:(NSNumber *)finished context:(void *)context {
    [self.bannerView removeFromSuperview];
    self.bannerView.delegate = nil;
    self.bannerView = nil;
}

- (void)slideOutBannerView:(AdSdkBannerView *)banner {
    
    // move banner to below the bottom of screen
    banner.center = CGPointMake(self.view.bounds.size.width/2.0, self.view.bounds.size.height - banner.bounds.size.height/2.0);

    // animate banner outside view
    [UIView beginAnimations:@"AdSdk" context:nil];
    [UIView setAnimationDuration:1];
    [UIView setAnimationDelegate:self];
    [UIView setAnimationDidStopSelector:@selector(slideOutDidStop:finished:context:)];
    banner.transform = CGAffineTransformMakeTranslation(0, banner.bounds.size.height);
    [UIView commitAnimations];
}

- (void)slideInBannerView:(AdSdkBannerView *)banner {
    
    banner.bounds = CGRectMake(0, 0, self.view.bounds.size.width, banner.bounds.size.height);
    
    // move banner to be at bottom of screen
    banner.center = CGPointMake(self.view.bounds.size.width/2.0, self.view.bounds.size.height - banner.bounds.size.height/2.0);
    
    // set transform to be outside of screen
    banner.transform = CGAffineTransformMakeTranslation(0, banner.bounds.size.height);
    
    // animate banner into view
    [UIView beginAnimations:@"AdSdk" context:nil];
    [UIView setAnimationDuration:1];
    banner.transform = CGAffineTransformIdentity;
    [UIView commitAnimations];
}

- (IBAction)requestBannerAdvert:(id)sender {
    
    if (!self.bannerView) {
        
        self.bannerView = [[AdSdkBannerView alloc] initWithFrame:CGRectZero];
        // size does not matter yet
        
        // Don't trigger an Advert load when setting delegate
        self.bannerView.allowDelegateAssigmentToRequestAd = NO;
        
        self.bannerView.delegate = self;
        
        self.bannerView.backgroundColor = [UIColor clearColor];
        self.bannerView.refreshAnimation = UIViewAnimationTransitionFlipFromLeft;
        
        self.bannerView.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleTopMargin;
        
        [self.view addSubview:self.bannerView];
    }

    self.bannerView.requestURL = @"http://52.4.145.155/cmtiads/md.request.php";

    [self.bannerView requestAd]; // Request a Banner Advert
    
}


- (IBAction)requestInterstitialAdvert:(id)sender {
    
    if(self.videoInterstitialViewController) {
        
        // If a BannerView is currently being displayed we should remove it
        if ([self isBannerViewInHiearchy]) {
            [self slideOutBannerView:self.bannerView];
        }
        
        self.videoInterstitialViewController.requestURL = @"http://52.4.145.155/cmtiads/md.request.php";
        
        [self.videoInterstitialViewController requestAd];
    }
}

#pragma mark AdSdk BannerView Delegate Methods

- (NSString *)publisherIdForAdSdkBannerView:(AdSdkBannerView *)banner {

    return @"226af592e76f7630018ef0a669ad8b2b+4086803612";
}

- (void)adsdkBannerViewDidLoadAdSdkAd:(AdSdkBannerView *)banner {
    NSLog(@"AdSdk Banner: did load ad");
    
    [self slideInBannerView:banner];
}

- (void)adsdkBannerViewDidLoadRefreshedAd:(AdSdkBannerView *)banner {
    NSLog(@"AdSdk Banner: Received a 'refreshed' advert");
    
    if (![self isBannerViewInHiearchy]) {
        
        [self slideInBannerView:banner];
    }
    else {
        
        banner.transform = CGAffineTransformIdentity;
        
        // animate banner into view
        [UIView beginAnimations:@"AdSdk" context:nil];
        [UIView setAnimationDuration:1];
        banner.transform = CGAffineTransformIdentity;
        [UIView commitAnimations];
    }
}

- (void)adsdkBannerView:(AdSdkBannerView *)banner didFailToReceiveAdWithError:(NSError *)error {
    
    NSLog(@"AdSdk Banner: did fail to load ad: %@", [error localizedDescription]);
    
    [self slideOutBannerView:bannerView];
}

#pragma mark AdSdk Interstitial Delegate Methods

- (NSString *)publisherIdForAdSdkVideoInterstitialView:(AdSdkVideoInterstitialViewController *)videoInterstitial {
    return @"b1b47070b4fec8545c56e358bf9194da+4086803612";
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
