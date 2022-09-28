import 'package:flutter/material.dart';
import 'package:Saaman_Vendor/data/model/response/base/api_response.dart';
import 'package:Saaman_Vendor/data/model/response/review_model.dart';
import 'package:Saaman_Vendor/data/repository/product_review_repo.dart';
import 'package:Saaman_Vendor/helper/api_checker.dart';

class ProductReviewProvider extends ChangeNotifier {
  final ProductReviewRepo productReviewRepo;
  ProductReviewProvider({@required this.productReviewRepo});

  List<ReviewModel> _reviewList;
  List<ReviewModel> get reviewList =>
      _reviewList != null ? _reviewList.reversed.toList() : _reviewList;

  Future<void> getReviewList(BuildContext context) async {
    ApiResponse apiResponse = await productReviewRepo.productReviewList();

    if (apiResponse.response != null &&
        apiResponse.response.statusCode == 200) {
      _reviewList = [];
      apiResponse.response.data.forEach((review) {
        ReviewModel reviewModel = ReviewModel.fromJson(review);
        _reviewList.add(reviewModel);
      });
      print(reviewList);
    } else {
      ApiChecker.checkApi(context, apiResponse);
    }
    notifyListeners();
  }
}
